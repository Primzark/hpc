(function(){
    const form = document.getElementById('donation-form');
    if(!form) return;
    const donationId = form.dataset.donationId;

    const stripeBtn = document.getElementById('pay-stripe');
    const paypalDiv = document.getElementById('paypal-button');

    if(stripeBtn){
        fetch('/donation/pay?donation='+donationId+'&provider=stripe')
            .then(r=>r.json())
            .then(data=>{
                if(!data.clientSecret) return;
                const stripe = Stripe(window.STRIPE_PUBLISHABLE_KEY);
                stripeBtn.addEventListener('click',()=>{
                    stripe.confirmCardPayment(data.clientSecret, {payment_method:{card:{token:null}}})
                          .then(()=>window.location='/donation/success?id='+donationId);
                });
            });
    }

    if(paypalDiv){
        fetch('/donation/pay?donation='+donationId+'&provider=paypal')
            .then(r=>r.json())
            .then(data=>{
                if(!data.approvalUrl) return;
                paypal.Buttons({
                    createOrder: () => data.approvalUrl,
                    onApprove: ()=>{ window.location='/donation/success?id='+donationId; }
                }).render('#paypal-button');
            });
    }
})();
