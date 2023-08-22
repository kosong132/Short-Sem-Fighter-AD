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


    // Create edit button
    const editButton = document.createElement('button');
    editButton.innerText = 'Edit';
    editButton.id = 'maineditButton';

    // Attach the "click" event to your editButton
    editButton.addEventListener('click', () => {
        alert('edit');
        var editFoodID = prompt("Edit Food's ID: ");
        if(editFoodID == null)
        {
          newFoodName.innerHTML = foodid;
        }
        else
        {
          foodid = (newFoodID.innerHTML = editFoodID);
          newFoodID.innerHTML = foodid;
        }
        var editFoodname = prompt("Edit Food's Chinese Name: ");
        if(editFoodname == null)
        {
          newFoodName.innerHTML = foodCName;
        }
        else
        {
          foodCName = (newFoodName.innerHTML = editFoodname);
          newFoodName.innerHTML = foodCName;
        }

        var editFoodEngname = prompt("Edit Food's English Name: ");
        if(editFoodEngname == null)
        {
          newFoodEngName.innerHTML = foodEngName;
        }
        else
        {
          foodEngName = (newFoodEngName.innerHTML = editFoodEngname);
          newFoodEngName.innerHTML = foodEngName;
        }

        var editFoodPrice = prompt("Edit Food's Price: ");
        if(editFoodPrice == null)
        {
          newFoodPrice.innerHTML = "RM " + foodPrice;
        }
        else
        {
          foodPrice = (newFoodPrice.innerHTML = editFoodPrice);
          newFoodPrice.innerHTML = "RM " + foodPrice;
        }

    })
    newFoodDetails.appendChild(editButton);
    editButton.className += " allbutton"; //add to div class
    editButton.className += " edit"; //add to div class


    // Create delete button
    const deleteButton = document.createElement('button');
    deleteButton.innerText = 'Delete';
    deleteButton.id = 'maindeleteButton';

    // Attach the "click" event to your deleteButton
    deleteButton.addEventListener('click', () => {
        alert('delete');
        newFood.remove();

    })
    newFoodDetails.appendChild(deleteButton);
    deleteButton.className += " allbutton"; //add to div class
    deleteButton.className += " delete"; //add to div class

};

button.addEventListener("click",OnButtonClick);


/*
const input = document.querySelector("input")
const output = document.querySelector("output")
let imagesArray = []

input.addEventListener("change", () => {
    const file = input.files
    imagesArray.push(file[0])
    displayImages()
  })

  function displayImages() {
    let images = ""
    imagesArray.forEach((image, index) => {
      images += `<div class="image">
                  <img src="${URL.createObjectURL(image)}" alt="image">
                  <span onclick="deleteImage(${index})">&times;</span>
                </div>`
    })
    output.innerHTML = images
  }

  function deleteImage(index) {
    imagesArray.splice(index, 1)
    displayImages()
  }
*/


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
}

//edit delete food=============================================================

