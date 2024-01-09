<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="<?php echo ($row['book_price'])?>"
		data-name="Book Rental"
		data-description="Book For Everyone"
		data-image="./images/logo.png"
		data-currency="usd"
		data-email="<?Php echo $_SESSION['customer_email']?>"
	>	</script>
