//fill in food detail===================================
var button = document.getElementById("addButton");
var grid = document.getElementById("grid-container2");

var OnButtonClick = function(){
    var newFood = document.createElement("div");
    grid.appendChild(newFood);
    newFood.className += " food";

    var newThumbnail = document.createElement("div");
    newFood.appendChild(newThumbnail);
    newThumbnail.className += " thumb";

//=============================================




//===============================================
    var newFoodDetails = document.createElement("div");
    newFood.appendChild(newFoodDetails);
    newFoodDetails.className += " details";

    var foodid = document.getElementById("foodid").value;
    var newFoodID = document.createElement("foodID");
    newFoodDetails.appendChild(newFoodID);
    newFoodID.innerHTML = foodid; //print out name
    newFoodID.className += " foodID"; //add to div class

    var foodCName = document.getElementById("foodCName").value;
    var newFoodName = document.createElement("name");
    newFoodDetails.appendChild(newFoodName);
    newFoodName.innerHTML = foodCName; //print out name
    newFoodName.className += " name"; //add to div class
    
    var foodEngName = document.getElementById("foodEngName").value;
    var newFoodEngName = document.createElement("engName");
    newFoodDetails.appendChild(newFoodEngName);
    newFoodEngName.innerHTML = foodEngName;
    newFoodEngName.className += " engName";

    var foodPrice = document.getElementById("foodPrice").value;
    var newFoodPrice = document.createElement("price");
    newFoodDetails.appendChild(newFoodPrice);
    newFoodPrice.innerHTML = "RM " + foodPrice;
    newFoodPrice.className += " price";


    
//add food=============================================================
    // Create add to cart button
    const addToCartButton = document.createElement('button');
    addToCartButton.innerText = 'Add To Cart';
    addToCartButton.id = 'mainaddToCartButton';
    // Attach the "click" event to your addToCartButton
    addToCartButton.addEventListener('click', () => {
        incrementValue();
        alert('Food added to cart');
    })
    newFoodDetails.appendChild(addToCartButton);
    addToCartButton.className += " allbutton"; //add to div class
    addToCartButton.className += " addToCart"; //add to div class

};
button.addEventListener("click",OnButtonClick);



//increment cart function==========================================
const incrementCount = document.getElementById("mainaddToCartButton");
const totalCount = document.getElementById("total-count");
var count = 0;
totalCount.innerHTML = count;
// Function to increment count
function incrementValue(){
    count++;
    totalCount.innerHTML = count;
}

//decrement cart function==========================================
const decrementCount = document.getElementById("");
// Function to increment count
function decrementValue(){
    if(count!=0)
    {
        count--;
        totalCount.innerHTML = count;
    }
    else{
        count = 0;
    }
}


//add food=============================================================
// Get the modal
var modal = document.getElementById('id01');
var addButton = document.getElementById('addButton');

// When the user clicks anywhere outside of the modal/click add button, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    if (event.target == addButton) {
        modal.style.display = "none";
        document.getElementById("foodid").value = "";
        document.getElementById("foodCName").value = "";
        document.getElementById("foodEngName").value = "";
        document.getElementById("foodPrice").value = "";
    }
};

//edit delete food=============================================================

