function redirectToPage(url) {
    window.location.href = url;
  }
  
  document.addEventListener("scroll", ()=>{
    const header = document.querySelector("header");
  
    if(window.scrollY > 0){
      header.classList.add("scrolled");
    }else{
      header.classList.remove("scrolled");
    }
  });
  const navMenu = document.querySelector(".navbar-nav")
  const hamburger = document.querySelector(".hamburger");
  const header = document.querySelector("header");
  
  hamburger.addEventListener("click", ()=>{
    navMenu.classList.toggle("active");
    hamburger.classList.toggle("active");
    header.classList.toggle("scrolled");
  });
  document.querySelectorAll(".nav-link").forEach(n => n.
  addEventListener("click", ()=>{
    hamburger.classList.remove("active");
    header.classList.remove("scrolled");
  }));
  window.addEventListener("resize", () => {
    navMenu.classList.remove("active"); // Added line to remove "active" class on navMenu when the window is resized
    hamburger.classList.remove("active"); // Added line to remove "active" class on hamburger when the window is resized
  });
