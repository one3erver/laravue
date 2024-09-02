import { router } from "@inertiajs/vue3";

let postCartTimeout: number | undefined = undefined;

export function useAddToLocalCart(
    id: number,
    count: number,
    onSuccses?: () => void,
    onFail?: () => void
) {
    //if the is a postCartTimeout then i means we have a post request in queue and we will be sending a new one soon,
    //to prevent spaming delete the old post request
    if (postCartTimeout) {
        clearTimeout(postCartTimeout);
    }

    //check if we have a cart in localstorage, if we do add to that cart
    if (localStorage.getItem("cart")) {
        //turn our cart to a array
        const cart = JSON.parse(
            localStorage.getItem("cart") as string
        ) as any[];

        //check if we have the product we are trying to add in our cart, if we dont the returned value would be -1
        let indexOfThisProductInCart = cart.findLastIndex((item) => {
            if (item.id === id) {
                return true;
            }
        });

        //if we have this product in our cart, update the count
        if (indexOfThisProductInCart != -1) {
            //if count reaches 0 delete it from the cart, else update it
            if (count <= 0) {
                cart.splice(indexOfThisProductInCart, 1);
            } else {
                cart[indexOfThisProductInCart].count = count;
            }
        }
        //if we dont have this product in our cart, add it in
        else {
            cart.push({ id, count });
        }

        //get the total count of items in cart including
        const total_count = cart.reduce(
            (sum, current) => sum + current.count,
            0
        );

        //dispatch cartchange event if a item is added
        window.dispatchEvent(
            new CustomEvent("cartchange", {
                detail: {
                    itemsInCart: total_count,
                    storage: localStorage.getItem("cart"),
                },
            })
        );

        //atlast store the cart as a string in localstorage
        localStorage.setItem("cart", JSON.stringify(cart));

        //post data to carts.store, it queues the posting in a timeout to prevent spaming by clicking add to cart rapidly
        postCartTimeout = setTimeout(() => {
            router.post(
                route("carts.store"),
                { cart_list: JSON.stringify(cart) },
                {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: onSuccses,
                    onFinish: onSuccses,
                    onError: onFail,
                }
            );
        }, 100);
    }
    //if we dont have a cart, create an empty one and then run this again
    else {
        localStorage.setItem("cart", JSON.stringify([]));
        useAddToLocalCart(id, count);
    }
}

export function useSyncCart(onSuccses?: () => void, onFail?: () => void) {
    //check if we have a cart in localstorage, if we do add to that cart
    const cart = localStorage.getItem("cart");
    if (cart) {
        //post data to carts.store, it queues the posting in a timeout to prevent spaming by clicking add to cart rapidly
        router.post(
            route("carts.store"),
            { cart_list: cart },
            {
                preserveState: true,
                preserveScroll: true,
                // onSuccess: onSuccses,
                onFinish: onSuccses,
                onError: onFail,
            }
        );
    }
    //if we dont have a cart, create an empty one and then run this again
    else {
        console.log("Cart is Empty");
    }
}

export function clearCart(onSuccses: () => void, onFail: () => void) {
    router.post(
        route("carts.store"),
        { cart_list: JSON.stringify([]) },
        {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                //dispatch cartchange event
                window.dispatchEvent(
                    new CustomEvent("cartchange", {
                        detail: {
                            itemsInCart: 0,
                            storage: JSON.stringify([]),
                        },
                    })
                );

                //atlast store a empty cart in localhost
                localStorage.setItem("cart", JSON.stringify([]));

                onSuccses();
            },
            onFinish: () => {
                //dispatch cartchange event
                window.dispatchEvent(
                    new CustomEvent("cartchange", {
                        detail: {
                            itemsInCart: 0,
                            storage: JSON.stringify([]),
                        },
                    })
                );

                //atlast store a empty cart in localhost
                localStorage.setItem("cart", JSON.stringify([]));

                onSuccses();
            },
            onError: onFail,
        }
    );
}

export function useDeleteSingleItemFromCart(
    id: number,
    onSuccess: () => void,
    onFail: () => void
) {
    const cart = localStorage.getItem("cart");
    if (!cart) {
        onFail();
        return;
    }

    const cart_as_json = JSON.parse(cart) as any[];

    let index = cart_as_json.findIndex((item) => {
        if (item.id === id) {
            return true;
        }
    });

    cart_as_json.splice(index, 1);

    localStorage.setItem("cart", JSON.stringify(cart_as_json));

    const itemsInCartCount = cart_as_json.reduce(
        (prev, current) => prev + current.count,
        0
    );

    router.post(
        route("carts.store"),
        { cart_list: JSON.stringify(cart_as_json) },
        {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                //dispatch cartchange event
                window.dispatchEvent(
                    new CustomEvent("cartchange", {
                        detail: {
                            itemsInCart: itemsInCartCount,
                            storage: JSON.stringify(cart_as_json),
                        },
                    })
                );

                //atlast store a empty cart in localhost
                localStorage.setItem("cart", JSON.stringify(cart_as_json));

                onSuccess();
            },
            onFinish: () => {
                //dispatch cartchange event
                window.dispatchEvent(
                    new CustomEvent("cartchange", {
                        detail: {
                            itemsInCart: itemsInCartCount,
                            storage: JSON.stringify(cart_as_json),
                        },
                    })
                );

                //atlast store a empty cart in localhost
                localStorage.setItem("cart", JSON.stringify(cart_as_json));

                onSuccess();
            },
            onError: onFail,
        }
    );
}

export function useDoesExistinCart(id: number) {
    if (localStorage.getItem("cart")) {
        //turn our cart to a array
        const cart = JSON.parse(
            localStorage.getItem("cart") as string
        ) as any[];

        //check if we have the product we are trying to add in our cart, if we dont the returned value would be -1
        let indexOfThisProductInCart = cart.findLastIndex((item) => {
            if (item.id === id) {
                return true;
            }
        });

        return indexOfThisProductInCart === -1
            ? null
            : (cart[indexOfThisProductInCart] as null | {
                  id: number;
                  count: number;
              });
    }
}

export function useNumberOfItemsInCart() {
    if (localStorage.getItem("cart")) {
        //turn our cart to a array
        const cart = JSON.parse(
            localStorage.getItem("cart") as string
        ) as any[];

        const itemsInCart = cart.reduce(
            (acum, currentValue) => acum + currentValue.count,
            0
        );

        return itemsInCart;
    } else {
        return 0;
    }
}
