const hamburgerIcon = document.querySelector('.hamburger');
const closeIcon = document.querySelector('.close-icon');
const mainNav = document.querySelector('.main-nav ul');
const hamburgerNav = document.querySelector('.hamburger');

// Store the original content of main-nav and hamburger
const originalMainNavContent = mainNav.innerHTML;
const originalHamburgerContent = hamburgerNav.innerHTML;

// Function to toggle the 'active' class
function toggleActiveClass() {
  hamburgerIcon.classList.toggle('active');
  closeIcon.classList.toggle('active');
  mainNav.classList.toggle('active');

  if (mainNav.classList.contains('active')) {
    // If the main-nav is visible, move its contents back to the hamburger div
    const navItems = mainNav.querySelectorAll('li');
    navItems.forEach((item) => {
      const cloneItem = item.cloneNode(true);
      hamburgerNav.appendChild(cloneItem);
    });
    mainNav.innerHTML = ''; // Clear the main-nav content
  } else {
    // If the main-nav is hidden, restore the original content
    mainNav.innerHTML = originalMainNavContent;
    hamburgerNav.innerHTML = originalHamburgerContent;
  }
}

// Add a click event listener to the hamburger icon to toggle the 'active' class
hamburgerIcon.addEventListener('click', toggleActiveClass);

// Add a click event listener to the close icon to toggle the 'active' class
closeIcon.addEventListener('click', toggleActiveClass);

// Function to animate the text in the banner
function animateBannerText() {
  const banner = document.getElementById('animated-banner');
  const texts = [
    "Welcome, Service Provider!",
    "Please log in to manage your business operations or register for an account."
  ];
  const speed = 100; // Adjust the speed of animation here (lower value means faster)

  let currentText = 0;
  let i = 0;

  function typeText() {
    if (i < texts[currentText].length) {
      banner.textContent += texts[currentText].charAt(i);
      i++;
      setTimeout(typeText, speed);
    } else {
      setTimeout(clearText, 2000); // Show each text for 2 seconds
    }
  }

  function clearText() {
    const textLength = banner.textContent.length;
    if (textLength > 0) {
      banner.textContent = banner.textContent.slice(0, textLength - 1);
      setTimeout(clearText, speed / 2);
    } else {
      currentText = (currentText + 1) % texts.length;
      i = 0;
      setTimeout(typeText, speed);
    }
  }

  typeText();

}

// Function to animate the text in the main section
function animateMainSectionText() {
  const animatedText = document.getElementById('animated-text');
  const texts = [
    "Register...",
    "Sign In...",
    "Manage your services.",
    "Manage your account.",
    "Place advertisements.",
    "Read & Respond to reviews.",
    "Manage your bookings from customers."
  ];
  const speed = 100; // Adjust the speed of animation here (lower value means faster)

  let currentText = 0;
  let i = 0;

  function typeText() {
    if (i < texts[currentText].length) {
      animatedText.textContent += texts[currentText].charAt(i);
      i++;
      setTimeout(typeText, speed);
    } else {
      setTimeout(clearText, 2000); // Show each text for 2 seconds
    }
  }

  function clearText() {
    const textLength = animatedText.textContent.length;
    if (textLength > 0) {
      animatedText.textContent = animatedText.textContent.slice(0, textLength - 1);
      setTimeout(clearText, speed / 2);
    } else {
      currentText = (currentText + 1) % texts.length;
      i = 0;
      setTimeout(typeText, speed);
    }
  }

  typeText();
}

// Call the function on page load
animateMainSectionText();

// Function to change the banner color dynamically
function changeBannerColor() {
  const banner = document.getElementById('animated-banner');
  banner.style.backgroundColor = '#b21'; // Change the color to your desired color
  banner.style.color = '#fff'; // Set the text color to contrast with the background color
}

// Call the functions on page load
animateBannerText();
changeBannerColor();


// JavaScript to handle scroll event
document.addEventListener('scroll', function() {
    const main = document.querySelector('body');
    if (window.scrollY > .5) {
        main.classList.add('scrolled');
    } else {
        main.classList.remove('scrolled');
    }
});



