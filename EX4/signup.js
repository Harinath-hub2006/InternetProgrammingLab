 document.getElementById("signupForm").addEventListener("submit", function(e) { 
  e.preventDefault(); 
  
  let isValid = true; 
  
  // Clear all previous error messages 
  document.getElementById("fullNameError").textContent = ""; 
  document.getElementById("emailError").textContent = ""; 
  document.getElementById("phoneError").textContent = ""; 
  document.getElementById("passwordError").textContent = ""; 
  document.getElementById("jobTitleError").textContent = ""; 
  document.getElementById("experienceError").textContent = ""; 
  document.getElementById("linkedinError").textContent = ""; 
  document.getElementById("resumeError").textContent = ""; 
  
  // Full Name 
  const fullName = document.getElementById("fullName").value.trim(); 
  if (fullName === "") { 
    document.getElementById("fullNameError").textContent = "Full name is required."; 
    isValid = false; 
  } else if (fullName.length < 2) { 
    document.getElementById("fullNameError").textContent = "Name must be at least 2 characters."; 
    isValid = false; 
  } 
  
  // Email 
  const email = document.getElementById("email").value.trim(); 
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
  if (email === "") { 
    document.getElementById("emailError").textContent = "Email is required."; 
    isValid = false; 
  } else if (!emailPattern.test(email)) { 
    document.getElementById("emailError").textContent = "Please enter a valid email address."; 
    isValid = false; 
  } 
  
  // Phone 
  const phone = document.getElementById("phone").value.replace(/\s/g, ""); 
  const phonePattern = /^[6-9]\d{9}$/; 
  if (phone === "") { 
    document.getElementById("phoneError").textContent = "Phone number is required."; 
    isValid = false; 
  } else if (!phonePattern.test(phone)) { 
    document.getElementById("phoneError").textContent = "Enter a valid 10 digit phone number."; 
    isValid = false; 
  } 
  
  // Password 
  const password = document.getElementById("password").value; 
  if (password === "") { 
    document.getElementById("passwordError").textContent = "Password is required."; 
    isValid = false; 
  } else if (password.length < 8 || !/[0-9]/.test(password)) { 
    document.getElementById("passwordError").textContent = "Password must be at least 8 characters and 
contain a number."; 
    isValid = false; 
  } 
  
  // Job Title 
  const jobTitle = document.getElementById("jobTitle").value.trim(); 
  if (jobTitle === "") { 
    document.getElementById("jobTitleError").textContent = "Desired job title is required."; 
    isValid = false; 
  } 
  
  // Experience 
  const experience = document.getElementById("experience").value; 
  if (experience === "") { 
    document.getElementById("experienceError").textContent = "Years of experience is required."; 
    isValid = false; 
  } else if (Number(experience) < 0 || Number(experience) > 50) { 
    document.getElementById("experienceError").textContent = "Experience must be between 0 and 50 
years."; 
    isValid = false; 
  } 
  
  // LinkedIn URL 
  const linkedin = document.getElementById("linkedin").value.trim(); 
  const linkedinPattern = /^https?:\/\/([\w-]+\.)?linkedin\.com\/.+$/i; 
  if (linkedin === "") { 
    document.getElementById("linkedinError").textContent = "LinkedIn URL is required."; 
    isValid = false; 
  } else if (!linkedinPattern.test(linkedin)) { 
    document.getElementById("linkedinError").textContent = "Enter a valid LinkedIn URL starting with 
https://linkedin.com/in/"; 
    isValid = false; 
  } 
  
  // Resume File 
  const resume = document.getElementById("resume").value; 
  const allowedExtensions = /(\.pdf|\.doc|\.docx)$/i; 
  if (resume === "") { 
    document.getElementById("resumeError").textContent = "Please upload your resume."; 
    isValid = false; 
  } else if (!allowedExtensions.test(resume)) { 
    document.getElementById("resumeError").textContent = "Only PDF or DOC/DOCX files are allowed."; 
    isValid = false; 
  } 
  
  if (isValid) { 
    document.getElementById("successMsg").textContent = "Registration successful! Welcome to 
HireHive."; 
    document.getElementById("successMsg").style.display = "block"; 
    document.getElementById("signupForm").reset(); 
  } 
});