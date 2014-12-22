package com.database.config;

import java.io.FileInputStream;
import java.util.Properties;
import java.util.ResourceBundle;



public class SystemConfig {
    static String configFile = "c3p0";
    public static String getConfigInfomation(String itemIndex) {
        try {
            ResourceBundle resource = ResourceBundle.getBundle(configFile);
            return resource.getString(itemIndex);
        } catch (Exception e) {
            return "";
        }
    }
}