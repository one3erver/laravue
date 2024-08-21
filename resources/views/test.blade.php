<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Form</title>
    <script>
        function submitForm() {
            const cartsList = [
                { product_id: 1, count: 5 },
                { product_id: 2, count: 4 },
                { product_id: 3, count: 3 },
            ];

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("orders.store") }}'; // Replace with your actual route

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}'; // CSRF token for Laravel
            form.appendChild(csrfToken);

            const productsInput = document.createElement('input');
            productsInput.type = 'hidden';
            productsInput.name = 'cartsList';
            productsInput.value = JSON.stringify(cartsList);
            form.appendChild(productsInput);

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</head>
<body>
<h1>Shopping Cart</h1>
<button onclick="submitForm()">Checkout</button>
</body>
</html>

