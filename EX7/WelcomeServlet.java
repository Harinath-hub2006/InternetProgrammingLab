import java.io.IOException; import java.io.PrintWriter; import javax.servlet.ServletException; import
javax.servlet.annotation.WebServlet; import javax.servlet.http.Cookie; import javax.servlet.http.HttpServlet; import
javax.servlet.http.HttpServletRequest; import javax.servlet.http.HttpServletResponse; import
javax.servlet.http.HttpSession;
@WebServlet("/WelcomeServlet") public class WelcomeServlet extends HttpServlet {
protected void doPost(HttpServletRequest request, HttpServletResponse response)
 throws ServletException, IOException {
 String username = request.getParameter("username");
 String password = request.getParameter("password");
 response.setContentType("text/html");
 PrintWriter out = response.getWriter();
 if (username == null || username.trim().isEmpty() || password == null || password.trim().isEmpty()) {
 out.println("<!DOCTYPE html><html><head><title>Login Error</title>");
 out.println("<style>body{font-family:Arial;margin:60px;background:#f4f6f8;text-align:center;}</style>");
 out.println("</head><body>");
 out.println("<h2 style='color:red;'>Username or Password cannot be empty!</h2>");
 out.println("<a href='index.html'>Go Back</a>");
 out.println("</body></html>");
 return;
 }
 String passwordRegex = "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).+$
 if (password == null || !password.matches(passwordRegex)) {
 out.println("<!DOCTYPE html><html><head><title>Password Policy Error</title>");
 out.println("<style>body{font-family:Arial;margin:60px;background:#f4f6f8;text-align:center;}</style>");
 out.println("</head><body>");
 out.println("<h2 style='color:red;'>Password does not meet security requirements!</h2>");
 out.println("<p>Password must include at least one lowercase letter, one uppercase letter, one number, and one
special character.</p><br>");
 out.println("<a href='index.html'>Try Again</a>");
 out.println("</body></html>");
 return;
 }
 HttpSession session = request.getSession();
 session.setAttribute("user", username);
 Cookie cookie = new Cookie("userCookie", username);
 response.addCookie(cookie);
 synchronized (getServletContext()) {
 Integer visitorCount = (Integer) getServletContext().getAttribute("visitorCount");
 if (visitorCount == null) {
 visitorCount = 0;
 }
 if (session.getAttribute("counted") == null) {
 visitorCount++;
 getServletContext().setAttribute("visitorCount", visitorCount);
 session.setAttribute("counted", true);
 }
 }
 Integer visitorCount = (Integer) getServletContext().getAttribute("visitorCount");
 out.println("<!DOCTYPE html><html><head><title>Welcome</title>");
 out.println("<style>body{font-family:Arial;margin:60px;background:#f4f6f8;}");
 out.println(".box{background:#fff;padding:25px 35px;border-radius:8px;");
 out.println("box-shadow:0 0 10px rgba(0,0,0,0.15);max-width:450px;margin:auto;}");
 out.println("a{display:block;margin:10px 0;color:#2c3e50;font-weight:bold;text-decoration:none;}");
 out.println("a:hover{text-decoration:underline;}");
 out.println("</style></head><body>");
 out.println("<div class='box'>");
 out.println("<h2>Welcome, " + username + "</h2>");
 out.println("<p><b>Total Unique Visitors So Far: " + visitorCount + "</b></p>");
 out.println("<h3>1. Hidden Form Field Demo</h3>");
 out.println("<form action='HiddenFieldServlet' method='post'>");
 out.println("<input type='hidden' name='hf' value='" + username + "'>");
 out.println("<input type='submit' value='Go (Hidden Field)'>");
 out.println("</form>");
 out.println("<h3>2. URL Rewriting Demo</h3>");
 out.println("<a href='URLRewriteServlet?username=" + username + "'>Visit (URL Rewriting)</a>");
 out.println("<h3>3. Cookie Demo</h3>");
 out.println("<a href='CookieServlet'>Visit (Cookies)</a>");
 out.println("<h3>4. HttpSession Demo</h3>");
 out.println("<a href='SessionServlet'>Visit (HttpSession)</a>");
 out.println("</div></body></html>");
}
protected void doGet(HttpServletRequest request, HttpServletResponse response)
 throws ServletException, IOException {
 response.getWriter().println("Please login on the home page first.");
}
}