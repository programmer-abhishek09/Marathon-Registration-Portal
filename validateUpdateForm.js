document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("form").addEventListener("submit", function (e) {
      const phone = document.querySelector("[name='phone']").value.trim();
      const newEmail = document.querySelector("[name='new_email']").value.trim();
      const newPassword = document.querySelector("[name='new_password']").value;
  
      const phoneRegex = /^[6-9]\d{9}$/;
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/;
  
      if (phone && !phoneRegex.test(phone)) {
        alert("❌ Phone number must be 10 digits and start with 6, 7, 8, or 9.");
        e.preventDefault();
        return;
      }
  
      if (newEmail && !emailRegex.test(newEmail)) {
        alert("❌ Please enter a valid email address.");
        e.preventDefault();
        return;
      }
  
      if (newPassword && !passwordRegex.test(newPassword)) {
        alert("❌ Password must be at least 8 characters long and contain uppercase, lowercase, and a special character.");
        e.preventDefault();
        return;
      }
    });
  });
  