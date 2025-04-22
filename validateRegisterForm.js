document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("form").addEventListener("submit", function (e) {
      const phone = document.querySelector("[name='phone']").value.trim();
      const email = document.querySelector("[name='email']").value.trim();
      const password = document.querySelector("[name='password']").value;
  
      const phoneRegex = /^[6-9]\d{9}$/;
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/;
  
      if (phone && !phoneRegex.test(phone)) {
        alert("❌ Phone number must be 10 digits and start with 6, 7, 8, or 9.");
        e.preventDefault();
        return;
      }
  
      if (email && !emailRegex.test(email)) {
        alert("❌ Please enter a valid email address.");
        e.preventDefault();
        return;
      }
  
      if (password && !passwordRegex.test(password)) {
        alert("❌ Password must be at least 8 characters long and contain uppercase, lowercase, and a special character.");
        e.preventDefault();
        return;
      }
    });
  });
  