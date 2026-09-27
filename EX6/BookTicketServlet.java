package com.ticket;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/BookTicketServlet")
public class BookTicketServlet extends HttpServlet {

    // Database connection details
    private static final String DB_URL = "jdbc:mysql://localhost:3306/ticket_booking_db";
    private static final String DB_USER = "root";     // Replace with your MySQL username
    private static final String DB_PASS = "Harin2357"; // Replace with your MySQL password

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        response.setContentType("text/html;charset=UTF-8");
        PrintWriter out = response.getWriter();

        // 1. Fetch parameters from HTML form
        String name = request.getParameter("name");
        String ageStr = request.getParameter("age");
        String category = request.getParameter("category");
        String source = request.getParameter("source");
        String destination = request.getParameter("destination");
        String seatsStr = request.getParameter("seats");

        int age = (ageStr != null && !ageStr.isEmpty()) ? Integer.parseInt(ageStr) : 0;
        int seats = (seatsStr != null && !seatsStr.isEmpty()) ? Integer.parseInt(seatsStr) : 1;

        if (source == null) source = "N/A";
        if (destination == null) destination = "N/A";

        try {
            // Load JDBC Driver
            Class.forName("com.mysql.cj.jdbc.Driver");

            // Establish Connection
            Connection conn = DriverManager.getConnection(DB_URL, DB_USER, DB_PASS);

            // 2. Insert ticket into database
            String insertQuery = "INSERT INTO tickets (name, age, category, source_location, destination, seats) VALUES (?, ?, ?, ?, ?, ?)";
            PreparedStatement pstmt = conn.prepareStatement(insertQuery);
            pstmt.setString(1, name);
            pstmt.setInt(2, age);
            pstmt.setString(3, category);
            pstmt.setString(4, source);
            pstmt.setString(5, destination);
            pstmt.setInt(6, seats);
            pstmt.executeUpdate();

            // 3. Fetch all updated tickets
            String selectQuery = "SELECT * FROM tickets ORDER BY id DESC";
            PreparedStatement selectStmt = conn.prepareStatement(selectQuery);
            ResultSet rs = selectStmt.executeQuery();

            // 4. Generate dynamic HTML output page
            out.println("<!DOCTYPE html>");
            out.println("<html><head><title>Booking Confirmation</title></head>");
            out.println("<body style='background:Azure;'>");
            out.println("<center><h2 style='color:green;'>Booking Successful!</h2></center>");
            out.println("<h3 style='color:tomato;' align='center'>All Stored Bookings (Database)</h3>");

            out.println("<table border='1' align='center' cellpadding='6' style='background:Snow;'>");
            out.println("<tr><th>ID</th><th>Name</th><th>Age</th><th>Category</th><th>Source</th><th>Destination</th><th>Seats</th><th>Booking Time</th></tr>");

            while (rs.next()) {
                out.println("<tr>");
                out.println("<td>" + rs.getInt("id") + "</td>");
                out.println("<td>" + rs.getString("name") + "</td>");
                out.println("<td>" + rs.getInt("age") + "</td>");
                out.println("<td>" + rs.getString("category") + "</td>");
                out.println("<td>" + rs.getString("source_location") + "</td>");
                out.println("<td>" + rs.getString("destination") + "</td>");
                out.println("<td>" + rs.getInt("seats") + "</td>");
                out.println("<td>" + rs.getTimestamp("booking_date") + "</td>");
                out.println("</tr>");
            }

            out.println("</table>");
            out.println("<br><center><a href='index.html'>Back to Main Menu</a></center>");
            out.println("</body></html>");

            conn.close();
        } catch (Exception e) {
            out.println("<h3>Error: " + e.getMessage() + "</h3>");
            e.printStackTrace(out);
        }
    }
}