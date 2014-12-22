import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import datasouce.DBConnectionManager;


public class aa extends HttpServlet {

	
	public void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		this.doPost(request, response);
	}

	
	public void doPost(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		 DBConnectionManager c=new DBConnectionManager();
		  Connection conn= c.getConnection();
		  Statement s;
		try {
			s = conn.createStatement();
			 String sql="select * from as_news";

			 ResultSet rs=s.executeQuery(sql);
			
			 while(rs.next()){
				  String a=rs.getString("title");
				  System.out.println("a="+a);
			 }
		} catch (SQLException e) {
			
			e.printStackTrace();
		}
		
		
	}

}
