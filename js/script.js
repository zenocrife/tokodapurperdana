const sidebar = document.querySelector(".sidebar");
const sidebarClose = document.querySelector("#sidebar-close");
const menu = document.querySelector(".menu-content");
const menuItems = document.querySelectorAll(".submenu-item");
const subMenuTitles = document.querySelectorAll(".submenu .menu-title");

sidebarClose.addEventListener("click", () => sidebar.classList.toggle("close"));

menuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    menu.classList.add("submenu-active");
    item.classList.add("show-submenu");
    menuItems.forEach((item2, index2) => {
      if (index !== index2) {
        item2.classList.remove("show-submenu");
      }
    });
  });
});

subMenuTitles.forEach((title) => {
  title.addEventListener("click", () => {
    menu.classList.remove("submenu-active");
  });
});

function openAddForm() {
  document.getElementById("addForm").style.display = "block";
  document.getElementById("overlay").style.display = "block";
}

function closeAddForm() {
  document.getElementById("addForm").style.display = "none";
  document.getElementById("overlay").style.display = "none";
}

function openEditForm() {
  var popup = document.getElementById("editForm");
  popup.style.display = "flex";
}

function closeEditForm() {
  var popup = document.getElementById("editForm");
  popup.style.display = "none";
}

//script untuk Delete Confirmation Pop Up
function openDeleteConfirmation() {
  document.getElementById("deleteConfirmation").style.display = "flex";
  document.getElementById("overlay").style.display = "block";
}

function closeDeleteConfirmation() {
  document.getElementById("deleteConfirmation").style.display = "none";
  document.getElementById("overlay").style.display = "none";
}

//script untuk Add Success Pop Up
function openAddSuccessForm() {
  document.getElementById("addSuccessForm").style.display = "block";
  document.getElementById("overlay").style.display = "block";
}

function closeAddSuccessForm() {
  document.getElementById("addSuccessForm").style.display = "none";
  document.getElementById("overlay").style.display = "none";
}

function submitAddForm() {
  closeAddForm();

  openAddSuccessForm();
}

document
  .getElementById("submitAddForm")
  .addEventListener("click", function (event) {
    event.preventDefault();
    submitAddForm();
  });

//script untuk Edit Success Pop Up
function openEditSuccessForm() {
  document.getElementById("editSuccessForm").style.display = "block";
  document.getElementById("overlay").style.display = "block";
}

function closeEditSuccessForm() {
  document.getElementById("editSuccessForm").style.display = "none";
  document.getElementById("overlay").style.display = "none";
}

function submitEditForm() {
  closeEditForm();

  openEditSuccessForm();
}

document
  .getElementById("submitEditForm")
  .addEventListener("click", function (event) {
    event.preventDefault();
    submitEditForm();
  });
