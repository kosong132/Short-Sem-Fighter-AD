<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Description Popup</title>
    <style>
        .food {
            cursor: pointer;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            display: inline-block;
        }

        /* Updated styles for the popup overlay */
        .popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent gray background */
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* CSS for the popup content */
.popup-content {
    background-color: #fff; /* White background */
    border: 1px solid #ccc;
    padding: 20px;
    max-width: 400px;
    text-align: center;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Box shadow for a subtle elevation */
}

/* Header style */
.popup-content h2 {
    font-size: 1.5rem;
    margin-bottom: 10px;
}

/* Food item style */
.food-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.food-img img {
    width: 80px; /* Adjust image width as needed */
    height: 60px; /* Adjust image height as needed */
    margin-right: 10px;
}

.food-details p {
    margin: 0;
    text-align: left;
}

/* Line separator */
.line {
    border-top: 1px solid #ccc;
    margin: 10px 0;
}

/* Total style */
.total p {
    font-weight: bold;
    font-size: 1.2rem;
}

/* Payment status and time style */
.popup-content h3 {
    font-size: 1.2rem;
    margin-top: 10px;
}
        .grid-container1 {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-template-rows: 0.5fr 0.5fr;
  gap: 20px;
  height: min-content;
}

.top{
  grid-column: 1 / 2;
  grid-row: 1 / 2;
  text-align: left;
  padding-top: 10px;
}
.grid-container{

  margin-top: 1rem;
  padding: 10px;
}

table, th, tr, td{
  border: 0.1rem solid black;
  border-collapse: collapse;
}

.orderdetailtable{
  border: none;
}

.infobox{
  display: grid;
  grid-template-rows: auto 2rem;
  border-radius: 1rem;
  border: 1px solid black;
  margin-bottom: 1.5rem;
  padding: 1.5rem;
  cursor: pointer;
}

.orderupper{
  display: grid;
}
.order-container{
  display: grid;
  grid-column: 2/3;
  grid-row: 1/2;
  grid-template-rows:2.5rem auto;
  grid-template-columns: 3.5fr 1.2fr;
}
.orderno{
  grid-row: 1 / 2;
  margin-bottom: 1rem;
  font-size: 1.8rem;
  height: 2rem;
}
.orderDetails{
  grid-row: 2/3;
  grid-column: 1/3;
}
.orderitem{
  display:grid;
  margin-top: 0.5rem;
  grid-template-columns: 1fr 3fr 0.5fr 1fr;
}
.menucode{
  grid-column: 1/2;
  grid-row: 1/2;
  text-align: left;
  font-size: 1.2rem;
}
.menuname{
  grid-column: 2/3;
  grid-row: 1/2;
  font-size: 1.2rem;
}
.quantityorder{
  grid-column: 3/4;
  grid-row: 1/2;
  text-align: center;
}
.price{
  grid-column: 4/5;
  text-align: right;
}
.line{
  display: flex;
  border-top: 1rem;
  border-top: 1px solid black;
  grid-row: 2/3;
  grid-column: 1/3;
  justify-content: right;
}
.orderupper{
  display: grid;
  margin-bottom: 1rem;
  grid-template-columns: 1fr 2.2fr;
}
.total{
  grid-row: 2/3;
  grid-column: 2/3;
  text-align: center;
   margin: 10px 0;
   padding-left: 4rem;
  font-size: 1.4rem;
}
.TotalPrice{
  grid-row: 2/3;
  grid-column: 2/3;
  padding-left: 1.5rem;
  text-align: right;
  margin: 10px 0;
  font-size: 1.4rem;
}
.foodimg{
  grid-column-start: 1;
  grid-column-end: 2; 
  grid-row: 1/2; 
  display:flex;
  justify-content: center;
  align-items: center;
}

.foodimg img{
  margin: auto 1rem;
  width: 10rem;
  height: 9rem;
  
}



  

  
  
  

    </style>
</head>
<body>
   

    <!-- Infobox structure -->
    <div class="infobox" onclick="showPopup('infobox1')">
        <div class="orderupper">
            <div class="foodimg"><img src="img/order-food.png"></div>
            <div class="order-container">
                <div class="orderno"> ORDER ID 3 </div>
                <div class="orderDetails">
                    <div class="orderitem">
                        <div class="menucode"> P01</div>
                        <div class="menuname"> Pizza</div>
                        <div class="quantityorder"> x 2</div>
                        <div class="price"> RM 100</div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="line">
                <div class="total">Total :</div>
                <div class="TotalPrice">RM 100</div>
            </div>
        </div>
    </div>

    <div class="popup-overlay" id="infobox1" onclick="hidePopup('infobox1')" style="display: none;">
    <div class="popup-content">
        <!-- Content for your infobox popup -->
        <h2>Order ID: 3</h2>
        
        <!-- Food 1 -->
        <div class="food-item">
            <div class="food-img"><img src="img/pizza.jpg" alt="Pizza"></div>
            <div class="food-details">
                <p>Food Name: Pizza</p>
                <p>Quantity: 2</p>
                <p>Subtotal: RM 100</p>
            </div>
        </div>

        <!-- Food 2 -->
        <div class="food-item">
            <div class="food-img"><img src="img/burger.jpg" alt="Burger"></div>
            <div class="food-details">
                <p>Food Name: Burger</p>
                <p>Quantity: 1</p>
                <p>Subtotal: RM 50</p>
            </div>
        </div>

        <!-- Add more food items as needed -->

        <!-- Total -->
        <div class="line"></div>
        <div class="total">
            <p>Total Amount: RM 150</p>
        </div>

        <!-- Payment Status and Time -->
        <h2>Payment Status: Paid</h2>
        <h2>Payment Time: 2023-09-14 15:30:00</h2>
    </div>
</div>

    <!-- Add more infobox items as needed -->

    <script>
        function showPopup(id) {
            const popup = document.getElementById(id);
            if (popup) {
                popup.style.display = "flex";
            }
        }

        function hidePopup(id) {
            const popup = document.getElementById(id);
            if (popup) {
                popup.style.display = "none";
            }
        }
    </script>
</body>
</html> -->