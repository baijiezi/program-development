package datasouce;

import java.sql.*;
import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import com.database.config.*;
import com.mchange.v2.c3p0.*;
public class DBConnectionManager {
  //  private static Log                   log = LogFactory.getLog(DatabaseAccessImpl.class);
    private static ComboPooledDataSource cpds = null;
    public static void init() {
      //  log.debug(">>>>>>>>>>>>>>>>>>>>> <DBConnectionManager.init> Begin");
        // 建立数据库连接池
        String DRIVER_NAME = SystemConfig.getConfigInfomation("DRIVER"); // 驱动器
        String DATABASE_URL = SystemConfig.getConfigInfomation("URL"); // 数据库连接url
        String DATABASE_USER = SystemConfig.getConfigInfomation("USERNAME"); // 数据库用户名
        String DATABASE_PASSWORD = SystemConfig.getConfigInfomation("PASSWORD"); // 数据库密�码
        int Min_PoolSize = 5;
        int Max_PoolSize = 50;
        int Acquire_Increment = 5;
        int Initial_PoolSize = 10;
        int Idle_Test_Period = 3000;// 每隔3000s测试连接是否可以正常使用
        String Validate = SystemConfig.getConfigInfomation("Validate");// 每次连接验证连接是否可用
        if (Validate.equals("")) {            Validate = "false";        }
        // 最小连接数
        try {
            Min_PoolSize = Integer.parseInt(SystemConfig.getConfigInfomation("Min_PoolSize"));
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        // 增量条数
        try {
            Acquire_Increment = Integer.parseInt(SystemConfig.getConfigInfomation("Acquire_Increment"));
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        // 最大连接数
        try {
            Max_PoolSize = Integer.parseInt(SystemConfig.getConfigInfomation("Max_PoolSize"));
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        // 初始化连接数
        try {
            Initial_PoolSize = Integer.parseInt(SystemConfig.getConfigInfomation("Initial_PoolSize"));
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        // 每隔3000s测试连接是否可以正常使用
        try {
            Idle_Test_Period = Integer.parseInt(SystemConfig.getConfigInfomation("Idle_Test_Period"));
        } catch (Exception ex) {
            ex.printStackTrace();
        }

        try {
            cpds = new ComboPooledDataSource();
            cpds.setDriverClass(DRIVER_NAME); // 驱动器
            cpds.setJdbcUrl(DATABASE_URL); // 数据库url
            cpds.setUser(DATABASE_USER); // 用户名
            cpds.setPassword(DATABASE_PASSWORD); // 密码
            cpds.setInitialPoolSize(Initial_PoolSize); // 初始化连接池大小
            cpds.setMinPoolSize(Min_PoolSize); // 最少连接数
            cpds.setMaxPoolSize(Max_PoolSize); // 最大连接数
            cpds.setAcquireIncrement(Acquire_Increment); // 连接数的增量
            cpds.setIdleConnectionTestPeriod(Idle_Test_Period); // �测连接有效的时间间隔
            cpds.setTestConnectionOnCheckout(Boolean.getBoolean(Validate)); // 每次连接验证连接是否可用
        } catch (Exception ex) {
            ex.printStackTrace();
        }
       // log.debug(">>>>>>>>>>>>>>>>>>>>> <DBConnectionManager.init> End");
    }

    public static Connection getConnection() {// 获取数据库连接
        Connection connection = null;
        try {
            if (cpds == null) {
                init();
            }
            connection = cpds.getConnection(); // getconnection
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return connection;
    }

    public static void release() {
        try {
            if (cpds != null) {
                cpds.close();
            }
        } catch (Exception ex) {
            ex.printStackTrace();
        }
    }
}