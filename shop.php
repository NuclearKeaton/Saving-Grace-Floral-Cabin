<?php
	include_once 'includes/dbh.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saving Grace Floral Cabin</title>

    <!-- BootStrap Refrences Begining -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- BootStrap Refrences End -->

    <!-- Our Stylesheets Begining -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <!-- Our Stylesheets End -->

		<!-- our JS start -->
		<script type="text/javascript" src="itemUpdates.js"></script>
		<!-- our JS end -->
  </head>
  <body>
		<?php
			$sql = "SELECT * FROM arrangement;";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			$items = array();
			if($resultCheck > 0)
			{
				while($row = mysqli_fetch_assoc($result))
				{
					array_push($items, $row['arr_Name'], $row['arr_price']);
				}
			}
		?>
    <div class="container">

      <!-- Logo Begining -->
      <header class = "jumbotron jumbotron-fluid">
        <img src="logoNew.png" alt="Logo" class="Logo">
      </header>
      <!-- Logo End -->

      <!-- Sidebar Begining -->
      <div class="sidebar-left"></div>
      <div class="sidebar-right"></div>
      <!-- Sidebar End -->

      <!-- Navbar Begining -->
      <nav class="navbar navbar-expand-md sticky-top">
        <a class="navbar-brand" href="order.html">Place Order</a>
        <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <span class="navbar-text">|</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <span class="navbar-text">|</span>
            </li>
            <li class="nav-item">
              <a class="nav-link current" href="shop.php">Shop</a>
            </li>
            <li class="nav-item">
              <span class="navbar-text">|</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="FAQ.html">FAQ</a>
            </li>
            <li class="nav-item">
              <span class="navbar-text">|</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About</a>
            </li>
            <li class="nav-item">
              <span class="navbar-text">|</span>
            </li>
            <li class="nav-item">
              <a class="nav-link cart" href="cart.html">Cart</a>
            </li>
          </ul>
        </div>
      </nav>
      <!-- Navber End -->

      <!-- Content Begining -->
      <section>
				<div class = "searchAndFilters">
					<div class = "searchBar">
						<input type="text" class="form-control" id="searchInput" placeholder="Type search here:">
					</div>
					<div class = "searchButton">
						<button type="button" class="btn btn-light" onclick = "search()">Search</button>
					</div>
					<div class = "searchAndFilterItem">
						<p class = "filter">
							Items Per Page:
						</p>
						<select name="itemsPerPage" id="ipp">
							<option value="6">6</option>
							<option value="12">12</option>
							<option value="24">24</option>
							<option value="48">48</option>
						</select>
					</div>
					<div class = "searchAndFilterItem">
						<p class = "filter">
							Sort:
						</p>
						<select name="Sorting" id="sort">
							<option value="default">Default</option>
							<option value="lh">Price: Low-High</option>
							<option value="hl">Price: High-Low</option>
						</select>
					</div>
				</div>
				<div class = "nextBackButtons">
				</div>
        <div class="odd">
					<div class = "itemsDisp" id = 'CardContainer'>
					</div>
        </div>
      </section>
      <!-- Content End -->

    </div>

    <!-- Footer Begining -->
    <footer>
      <p> &copy;2021 Saving Grace Floral Cabin. Email us at: <a href="mailto:designsbymollyjo2020@gmail.com">designsbymollyjo2020@gmail.com</a> and Check out our <a href="https://www.facebook.com/floralcabin/" target="_blank">Facebook!</a></p>
    </footer>
    <!-- Footer End -->
		<script type = "text/javascript">
			var items = <?php echo json_encode($items); ?>;
			var container = document.getElementById('odd');
			var buttons = <?php echo json_encode($items); ?>;
			var allItems = <?php echo json_encode($items); ?>;
			var j = 0;
			updateStoreFront();
			function updateStoreFront(){
				clearFront();
				if(items.length == 0)
				{
					var cont = document.getElementById('CardContainer');
					var noneFound = document.createElement("p");
					noneFound.innerHTML = "We're sorry but no items where found matching that search.";
					cont.appendChild(noneFound);
				}
				for(var i = 0; i < items.length; i+=2)
				{
					var cont = document.getElementById('CardContainer');
					var cardBase = document.createElement('div');
					cardBase.className = "card";
					cardBase.style = "width: 18rem;";
					var image = document.createElement('img');
					image.className = "card-img-top";
					image.src = "Flowers-5.jpg";
					image.alt = "Test Image";
					var cardBody = document.createElement('div');
					cardBody.className = "card-body";
					var title = document.createElement('h5');
					title.className = "card-title";
					title.innerHTML = items[i];
					title.id = j+"title";
					var price = document.createElement('p');
					price.className = "card-text";
					price.innerHTML = "$" + items[i+1];
					price.id = j + "price";
					var button = document.createElement('a')
					button.className = "btn btn-light";
					button.innerHTML = "View Item";
					button.id = j;
					button.onclick = function(){passItem(this.id)};
					buttons.push(button);

					//PayPal button creation Begining
					var paypalButton = document.createElement("form");
					paypalButton.target = "paypal";
					paypalButton.action = "https://www.paypal.com/cgi-bin/webscr";
					paypalButton.method = "post";

					var cmd = document.createElement('input')
					cmd.type = "hidden";
					cmd.name = "cmd";
					cmd.value = "_cart";

					var business = document.createElement('input')
					business.type = "hidden";
					business.name = "business";
					business.value = "Meganuke5000@gmail.com";

					var lc = document.createElement('input')
					lc.type = "hidden";
					lc.name = "lc";
					lc.value = "en_US";

					var item_name = document.createElement('input')
					item_name.type = "hidden";
					item_name.name = "item_name";
					item_name.value = items[i];

					var amount = document.createElement('input')
					amount.type = "hidden";
					amount.name = "amount";
					amount.value = items[i+1];

					var currency_code = document.createElement('input')
					currency_code.type = "hidden";
					currency_code.name = "currency_code";
					currency_code.value = "USD";

					var button_subtype = document.createElement('input')
					button_subtype.type = "hidden";
					button_subtype.name = "button_subtype";
					button_subtype.value = "products";

					var no_note = document.createElement('input')
					no_note.type = "hidden";
					no_note.name = "no_note";
					no_note.value = "0";

					var tax_rate = document.createElement('input')
					tax_rate.type = "hidden";
					tax_rate.name = "tax_rate";
					tax_rate.value = "6.500";

					var shipping = document.createElement('input')
					shipping.type = "hidden";
					shipping.name = "shipping";
					shipping.value = "0.00";

					var add = document.createElement('input')
					add.type = "hidden";
					add.name = "add";
					add.value = "1";

					var bn = document.createElement('input')
					bn.type = "hidden";
					bn.name = "bn";
					bn.value = "PP-ShopCartBF:btn_cart_LG.gif:NonHostedGuest";


					//********************************************************************************************************************************************
					//********************************************************************************************************************************************
					//CHANGE THIS PIECE BEFORE CONSIDERING COMPLETED *********************************************************************************************
					var shopping_url = document.createElement('input')
					shopping_url.type = "hidden";
					shopping_url.name = "shopping_url";
					shopping_url.value = "http://localhost/Website/shop.php";
					//********************************************************************************************************************************************
					//********************************************************************************************************************************************
					//********************************************************************************************************************************************


					var submit = document.createElement('input')
					submit.type = "image";
					submit.src = "https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif";
					submit.border = "0";
					submit.name = "submit";
					submit.alt = "PayPal - The safer, easier way to pay online!";

					var pic = document.createElement('image')
					pic.alt = "";
					pic.src = "https://www.paypalobjects.com/en_US/i/scr/pixel.gif";
					pic.width = "1";
					pic.height = "1";

					paypalButton.appendChild(cmd);
					paypalButton.appendChild(business);
					paypalButton.appendChild(lc);
					paypalButton.appendChild(item_name);
					paypalButton.appendChild(amount);
					paypalButton.appendChild(currency_code);
					paypalButton.appendChild(button_subtype);
					paypalButton.appendChild(no_note);
					paypalButton.appendChild(tax_rate);
					paypalButton.appendChild(shipping);
					paypalButton.appendChild(add);
					paypalButton.appendChild(bn);
					paypalButton.appendChild(shopping_url);
					paypalButton.appendChild(submit);
					paypalButton.appendChild(pic);
					//PayPal button creation End

					cardBody.appendChild(title);
					cardBody.appendChild(price);
					cardBody.appendChild(button);
					cardBase.appendChild(image);
					cardBase.appendChild(cardBody);
					cardBase.appendChild(paypalButton);
					cont.appendChild(cardBase);
					j++;
				}
			}
			function clearFront()
			{
				var cont = document.getElementById('CardContainer');
				while(cont.firstChild)
				{
					cont.removeChild(cont.firstChild);
				}
			}
			function search()
			{
				var searchString = document.getElementById("searchInput").value;
				if(searchString != "")
				{
						items = [];
						for(var i =0; i< allItems.length; i+=2)
						{
							if(allItems[i].includes(searchString))
							{
								items.push(allItems[i], allItems[i+1]);
							}
						}
						updateStoreFront();
				}else
				{
					items = allItems;
					updateStoreFront();
				}
			}
		</script>
  </body>
</html>
