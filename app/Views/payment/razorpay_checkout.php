<button id="rzp-button1">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "rzp_test_GIszA4oBMH50bF", // Enter the Key ID generated from the Dashboard
    "amount": <?= $order->amount ?>, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "Acme Corp",
    "description": "Test Transaction",
    "image": "https://example.com/your_logo",
    "order_id": "<?= $order->id ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "callback_url": "/payment/success",
    "prefill": {
        "name": "Aryan",
        "email": "ayushk9304@gmail.com",
        "contact": "9000090000"
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);


document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>