export function useAddToLocalCart(product_id: number, quantity: number) {
    //check if we have a cart in localstorage, if we do add to that cart
    if (localStorage.getItem("cart")) {
        //turn our cart to a array
        const cart = JSON.parse(
            localStorage.getItem("cart") as string
        ) as any[];

        //check if we have the product we are trying to add in our cart, if we dont the returned value would be -1
        let indexOfThisProductInCart = cart.findLastIndex((item) => {
            if (item.product_id === product_id) {
                return true;
            }
        });

        //if we have this product in our cart, update the quantity
        if (indexOfThisProductInCart != -1) {
            //if quantity reaches 0 delete it from the cart, else update it
            if (quantity <= 0) {
                cart.splice(indexOfThisProductInCart, 1);
            } else {
                cart[indexOfThisProductInCart].quantity = quantity;
            }
        }
        //if we dont have this product in our cart, add it in
        else {
            cart.push({ product_id, quantity });
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
    }
    //if we dont have a cart, create an empty one and then run this again
    else {
        localStorage.setItem("cart", JSON.stringify([]));
        useAddToLocalCart(product_id, quantity);
    }
}

export function useDoesExistinCart(product_id: number) {
    if (localStorage.getItem("cart")) {
        //turn our cart to a array
        const cart = JSON.parse(
            localStorage.getItem("cart") as string
        ) as any[];

        //check if we have the product we are trying to add in our cart, if we dont the returned value would be -1
        let indexOfThisProductInCart = cart.findLastIndex((item) => {
            if (item.product_id === product_id) {
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
