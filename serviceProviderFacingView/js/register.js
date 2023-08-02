// Function to handle subscription selection
function selectSubscription(subscriptionModel, monthlyPrice, annualPrice) {
    const registerForm = document.getElementById("register");
    const subscriptionModelInput = document.getElementById("subscription_model");
    const selectedSubscriptionModel = document.getElementById("selected_subscription_model");
    subscriptionModelInput.value = subscriptionModel;
    selectedSubscriptionModel.textContent = subscriptionModel;
  
    // Check if there's a form currently displayed
    const currentDisplayedForm = document.querySelector(".register-form.active");
    if (currentDisplayedForm) {
      currentDisplayedForm.classList.remove("active");
    }
  
    // Show the new form
    registerForm.classList.add("active");
}

// Function to show the "Register here" paragraph and hide the "Choose a plan and register" paragraph
function showRegisterHereParagraph() {
    const registerLinkParagraph = document.getElementById("register-link-paragraph");
    const registerHereParagraph = document.getElementById("register-here-paragraph");

    registerLinkParagraph.style.display = "none";
    registerHereParagraph.style.display = "block";
}

// Function to scroll to the register form
function scrollToRegisterForm() {
    const registerForm = document.getElementById('register');
    registerForm.scrollIntoView({ behavior: 'smooth' });
}

// Add event listener to the "Register" button
const registerButton1 = document.getElementById('monthly_option'); // Use the appropriate id for the "Register" button
const registerButton2 = document.getElementById('annual_option'); // Use the appropriate id for the "Register" button
const registerButton3 = document.getElementById('free_option'); // Use the appropriate id for the "Register" button

registerButton1.addEventListener('click', scrollToRegisterForm);
registerButton2.addEventListener('click', scrollToRegisterForm);
registerButton3.addEventListener('click', scrollToRegisterForm);


// Attach the event listener to the subscription options
const monthlyOption = document.getElementById("monthly_option");
const annualOption = document.getElementById("annual_option");
const freeOption = document.getElementById("free_option");

monthlyOption.addEventListener("click", function() {
    selectSubscription("Monthly", "N$X", "-");
    showRegisterHereParagraph();
});

annualOption.addEventListener("click", function() {
    selectSubscription("Annual", "-", "N$Y");
    showRegisterHereParagraph();
});

freeOption.addEventListener("click", function() {
    selectSubscription("Free (First 3 Months)", "Free", "-");
    showRegisterHereParagraph();
});

// Function to scroll to the pricing section when clicking on the "Choose a plan and register" link
function scrollToPricingSection() {
    const pricingSection = document.getElementById("pricing");
    pricingSection.scrollIntoView({ behavior: "smooth" });
}

// Attach the event listener to the "Choose a plan and register" link
const registerLink = document.querySelector("a[href='#pricing']");
registerLink.addEventListener("click", scrollToPricingSection);

// Function to scroll to the registration form when clicking on the "Register here" link
function scrollToRegisterForm() {
    const registerForm = document.getElementById("register");
    registerForm.scrollIntoView({ behavior: "smooth" });
}

// Attach the event listener to the "Register here" link
const registerHereLink = document.querySelector("a[href='#register']");
registerHereLink.addEventListener("click", scrollToRegisterForm);

// Function to update character count and check for maximum length
function countCharacters() {
const bioTextarea = document.getElementById("bio");
const bioAlert = document.getElementById("bio-alert");
const charCountSpan = document.getElementById("char-count");
const wordCountSpan = document.getElementById("word-count");

const maxCharLimit = 100;

const bioValue = bioTextarea.value;
const charCount = bioValue.length;
const wordCount = bioValue.split(/\s+/).filter(Boolean).length;

charCountSpan.textContent = maxCharLimit - charCount;
wordCountSpan.textContent = wordCount;

if (charCount > maxCharLimit) {
    bioAlert.textContent = "You've exceeded the maximum character limit!";
    bioAlert.style.display = "block";
    } else if (charCount >= 0) {
        bioAlert.textContent = ""; // Clear the alert if it was previously shown
        bioAlert.style.display = "none";
    } else {
        bioAlert.textContent = "You've reached the maximum characters.";
        bioAlert.style.display = "block";
    }
}

// Attach the event listener to the textarea
const bioTextarea = document.getElementById("bio");
bioTextarea.addEventListener("input", countCharacters);

// Call the function initially to set the initial character count
countCharacters();

// JavaScript code for profile picture and cover photo previews
function previewProfilePicture(event) {
  const fileInput = event.target;
  const profilePicturePreview = document.getElementById("profile_picture_preview");
  const file = fileInput.files[0];
  const reader = new FileReader();

  reader.onloadend = function () {
      profilePicturePreview.src = reader.result;
  };

  if (file) {
      reader.readAsDataURL(file);
  } else {
      profilePicturePreview.src = "#";
  }
}

function previewCoverPhoto(event) {
  const fileInput = event.target;
  const coverPhotoPreview = document.getElementById("cover_photo_preview");
  const file = fileInput.files[0];
  const reader = new FileReader();

  reader.onloadend = function () {
      coverPhotoPreview.src = reader.result;
  };

  if (file) {
      reader.readAsDataURL(file);
  } else {
      coverPhotoPreview.src = "#";
  }
}
