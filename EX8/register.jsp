<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html>
    <head>
    <title>Registration Successful</title>
   <style>
    body { 
        font-family: Arial, sans-serif; 
        background: linear-gradient(135deg, #f0f4f9 0%, #d9e2ec 100%); 
        margin: 0; 
        padding: 0; 
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .details-container {
        width: 420px; 
        margin: 60px auto; 
        background: #ffffff;
        padding: 40px 30px; 
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(45, 108, 223, 0.1);
        border-top: 4px solid #27ae60;
        text-align: center;
        flex: 1;
    }
    .success-icon {
        font-size: 50px;
        color: #27ae60;
        margin-bottom: 15px;
    }
    h2 { 
        color: #2c3e50; 
        margin-top: 0;
        margin-bottom: 12px;
        font-size: 24px;
    }
    p {
        color: #666666;
        font-size: 15px;
        line-height: 1.5;
        margin-bottom: 25px;
    }
    table { width: 100%; border-collapse: collapse; margin-top: 15px; text-align: left; }
    td { padding: 10px; border-bottom: 1px solid #eeeeee; font-size: 14px; color: #333333; }
    td.label { font-weight: bold; color: #555555; width: 45%; }
    .btn-home {
        display: inline-block;
        width: 100%;
        padding: 12px;
        background-color: #2d6cdf; 
        color: white; 
        text-decoration: none;
        border-radius: 4px; 
        font-size: 16px; 
        font-weight: bold;
        box-sizing: border-box;
        margin-top: 20px;
        transition: background-color 0.2s;
    }
    .btn-home:hover { 
        background-color: #1a52b8; 
    }
</style>
</head>
<body>
<%
    // Retrieve form parameters submitted from register.html
    String username = request.getParameter("username");
    String password = request.getParameter("password");
    String name     = request.getParameter("name");
    String ccnumber = request.getParameter("ccnumber");
    String email    = request.getParameter("email");
    String phone    = request.getParameter("phone");
%>
     <div class="details-container">
        <h2>Registration Successful</h2>
        <table>
            <tr><td class="label">User Name:</td><td><%= username %></td></tr>
            <tr><td class="label">Password:</td><td><%= password %></td></tr>
            <tr><td class="label">Name:</td><td><%= name %></td></tr>
            <tr><td class="label">Credit Card Number:</td><td><%= ccnumber %></td></tr>
                        <tr><td class="label">Email:</td><td><%= email %></td></tr>
            <tr><td class="label">Phone Number:</td><td><%= phone %></td></tr>
        </table>
    </div> </body></html>


