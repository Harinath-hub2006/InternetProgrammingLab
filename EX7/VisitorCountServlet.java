import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
@WebServlet(urlPatterns = {"/VisitorCountServlet"})
public class VisitorCountServlet extends HttpServlet {
 @Override
 protected void doGet(HttpServletRequest request, HttpServletResponse response)
 throws ServletException, IOException {
 HttpSession session = request.getSession();
 ServletContext context = getServletContext();
 synchronized (context) {
 Integer count = (Integer) context.getAttribute("visitorCount");
 if (count == null) count = 0;
 if (session.getAttribute("visited") == null) {
 count++;
 context.setAttribute("visitorCount", count);
 session.setAttribute("visited", true);
 }
 }
 response.setContentType("text/html");
 PrintWriter out = response.getWriter();
 out.println("Unique Visitors: " + context.getAttribute("visitorCount"));
 }
}