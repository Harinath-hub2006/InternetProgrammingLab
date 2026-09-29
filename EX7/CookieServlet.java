import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
@WebServlet("/CookieServlet")
public class CookieServlet extends HttpServlet {
 protected void doGet(HttpServletRequest request, HttpServletResponse response)
 throws ServletException, IOException {
 String name = "Guest";
 Cookie[] cookies = request.getCookies();
 if (cookies != null) {
 for (Cookie c : cookies) {
 if (c.getName().equals("userCookie")) {
 name = c.getValue();
 }
 }
 }
 response.setContentType("text/html");
 PrintWriter out = response.getWriter();
 out.println("<!DOCTYPE html><html><head><title>Cookie Result</title>");
 out.println("<style>body{font-family:Arial;margin:60px;background:#f4f6f8;}");
 out.println(".box{background:#fff;padding:25px 35px;border-radius:8px;");
 out.println("box-shadow:0 0 10px rgba(0,0,0,0.15);max-width:400px;margin:auto;text-align:center;}");
 out.println("</style></head><body>");
 out.println("<div class='box'>");
 out.println("<h2>Hello, " + name + "</h2>");
 out.println("<p>(This value was retrieved from an HTTP Cookie stored in the browser.)</p>");
 out.println("</div></body></html>");
 }
}