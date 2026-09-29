import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
@WebServlet("/SessionServlet")
public class SessionServlet extends HttpServlet {
 protected void doGet(HttpServletRequest request, HttpServletResponse response)
 throws ServletException, IOException {
 HttpSession session = request.getSession(false);
 String name = (session != null) ? (String) session.getAttribute("user") : "Guest";

 response.setContentType("text/html");
 PrintWriter out = response.getWriter();
 out.println("<!DOCTYPE html><html><head><title>HttpSession Result</title>");
 out.println("<style>body{font-family:Arial;margin:60px;background:#f4f6f8;}");
 out.println(".box{background:#fff;padding:25px 35px;border-radius:8px;");
 out.println("box-shadow:0 0 10px rgba(0,0,0,0.15);max-width:400px;margin:auto;text-align:center;}");
 out.println("</style></head><body>");
 out.println("<div class='box'>");
 out.println("<h2>Hello, " + name + "</h2>");
 out.println("<p>(This value was retrieved securely via server-side HttpSession storage.)</p>");
 out.println("</div></body></html>");
 }
}