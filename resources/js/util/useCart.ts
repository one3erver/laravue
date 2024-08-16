import { router } from "@inertiajs/vue3";

export function useAddToLocalCart(id: number, count: number) {
    //check if we have a cart in localstorage, if we do add to that cart
    if (localStorage.getItem("cart")) {
        //turn our cart to a array
        const cart = JSON.parse(
            localStorage.getItem("cart") as string
        ) as any[];

        //check if we have the product we are trying to add in our cart, if we dont the returned value would be -1
        let indexOfThisProductInCart = cart.findLastIndex((item) => {
            if (item.product_id === id) {
                return true;
            }
        });

        //if we have this product in our cart, update the quantity
        if (indexOfThisProductInCart != -1) {
            //if quantity reaches 0 delete it from the cart, else update it
            if (count <= 0) {
                cart.splice(indexOfThisProductInCart, 1);
            } else {
                cart[indexOfThisProductInCart].quantity = count;
            }
        }
        //if we dont have this product in our cart, add it in
        else {
            cart.push({ id, quantity: count });
        }

        //dispatch cartchange event if a item is added
        window.dispatchEvent(
            new CustomEvent("cartchange", {
                detail: {
                    itemsInCart: cart.length,
                    storage: localStorage.getItem("cart"),
                },
            })
        );

        //atlast store the cart as a string in localstorage
        localStorage.setItem("cart", JSON.stringify(cart));

        //post data
        router.post(
            route("carts.store"),
            { cart_list: JSON.stringify(cart) },
            {
                preserveState: true,
                preserveScroll: true,
            }
        );
    }
    //if we dont have a cart, create an empty one and then run this again
    else {
        localStorage.setItem("cart", JSON.stringify([]));
        useAddToLocalCart(id, count);
    }
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
                  product_id: number;
                  quantity: number;
              });
    }
}

export function useNumberOfItemsInCart() {
    if (localStorage.getItem("cart")) {
        //turn our cart to a array
        const cart = JSON.parse(
            localStorage.getItem("cart") as string
        ) as any[];

        console.log(cart.length);

        return cart.length;
    } else {
        return 0;
    }
}
