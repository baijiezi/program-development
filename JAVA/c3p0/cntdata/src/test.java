import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;


import datasouce.DBConnectionManager;


public class test {

	/**
	 * @param args
	 * @throws SQLException 
	 */
	public static void main(String[] args) throws SQLException {
		  DBConnectionManager c=new DBConnectionManager();
		  Connection conn= c.getConnection();
		  Statement s=conn.createStatement();
		 String sql="select * from as_news";

		 ResultSet rs=s.executeQuery(sql);
		
		 while(rs.next()){
			  String a=rs.getString("title");
			  System.out.println("a="+a);
		 }

	}

}
