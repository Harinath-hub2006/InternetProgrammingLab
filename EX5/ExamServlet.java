import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/ExamServlet")
public class ExamServlet extends HttpServlet {

    // Correct answers (kept server-side so they cannot be tampered with by the client)
    private static final String CORRECT_Q1 = "Hyper Text Markup Language";
    private static final String CORRECT_Q2 = "CSS";
    private static final String CORRECT_Q3 = "a";
    private static final String CORRECT_Q4 = "/";
    private static final String CORRECT_Q5 = "Web Browser";

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        // 1. Read submitted values
        String studentName = request.getParameter("fullName");
        String q1 = request.getParameter("q1");
        String q2 = request.getParameter("q2");
        String q3 = request.getParameter("q3");
        String q4 = request.getParameter("q4");
        String q5 = request.getParameter("q5");

        // 2. Evaluate answers
        int score = 0;
        boolean r1 = CORRECT_Q1.equalsIgnoreCase(q1);
        boolean r2 = CORRECT_Q2.equalsIgnoreCase(q2);
        boolean r3 = CORRECT_Q3.equalsIgnoreCase(q3);
        boolean r4 = CORRECT_Q4.equalsIgnoreCase(q4);
        boolean r5 = CORRECT_Q5.equalsIgnoreCase(q5);

        if (r1) score++;
        if (r2) score++;
        if (r3) score++;
        if (r4) score++;
        if (r5) score++;

        int totalQuestions = 5;

        // 3. Build the result page
        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        out.println("<!DOCTYPE html>");
        out.println("<html><head><title>Quiz Result</title>");
        out.println("<style>");
        out.println("body{font-family:Arial,sans-serif;background:#f4f6f8;padding:30px;}");
        out.println(".box{max-width:600px;margin:auto;background:#fff;padding:25px 30px;"
                + "border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.15);}");
        out.println("h2{color:#2c3e50;text-align:center;}");
        out.println("table{width:100%;border-collapse:collapse;margin-top:15px;}");
        out.println("td,th{border:1px solid #ddd;padding:8px;text-align:left;}");
        out.println("th{background:#2c3e50;color:#fff;}");
        out.println(".correct{color:green;font-weight:bold;}");
        out.println(".wrong{color:red;font-weight:bold;}");
        out.println(".score{font-size:20px;text-align:center;margin-top:20px;color:#2c3e50;}");
        out.println("</style></head><body>");

        out.println("<div class='box'>");
        out.println("<h2>Quiz Result</h2>");
        out.println("<p><b>Name:</b> " + escape(studentName) + "</p>");

        out.println("<table>");
        out.println("<tr><th>Question</th><th>Your Answer</th><th>Correct Answer</th><th>Result</th></tr>");

        printRow(out, "1. Full Form of HTML", q1, CORRECT_Q1, r1);
        printRow(out, "2. Language for Styling Sheets", q2, CORRECT_Q2, r2);
        printRow(out, "3. Tag for creating Hyperlink", q3, CORRECT_Q3, r3);
        printRow(out, "4. Closing Tag in HTML", q4, CORRECT_Q4, r4);
        printRow(out, "5. Used to read a HTML page and render it", q5, CORRECT_Q5, r5);

        out.println("</table>");

        out.println("<div class='score'>Final Score: " + score + " / " + totalQuestions + "</div>");
        out.println("<div class='score'>Percentage: " + (score * 100 / totalQuestions) + "%</div>");

        out.println("</div></body></html>");
    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html");
        response.getWriter().println("Please submit the quiz form to see results.");
    }

    private void printRow(PrintWriter out, String question, String userAnswer,
                           String correctAnswer, boolean isCorrect) {
        out.println("<tr>");
        out.println("<td>" + question + "</td>");
        out.println("<td>" + escape(userAnswer) + "</td>");
        out.println("<td>" + correctAnswer + "</td>");
        out.println("<td class='" + (isCorrect ? "correct'>Correct" : "wrong'>Wrong") + "</td>");
        out.println("</tr>");
    }

    private String trim(String s) {
        return s == null ? "" : s.trim();
    }

    // Basic HTML-escaping to avoid rendering issues / XSS from user input
    private String escape(String s) {
        if (s == null) return "";
        return s.replace("&", "&amp;")
                .replace("<", "&lt;")
                .replace(">", "&gt;")
                .replace("\"", "&quot;");
    }
}
