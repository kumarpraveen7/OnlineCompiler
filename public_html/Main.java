
import java.util.*;
public class Main
{
public static void main(String[] args) {
// Type safe array list, stores only string
List<String> l = new ArrayList<String>(5);
l.add(" welcome");
l.add("class");
l.add("Java");
l.add("class");

System.out.println("first index of class :" + l.indexOf("class"));
System.out.println("last index of class :"+l.lastIndexOf("class"));
System.out.println("Index of element"+" not present : " + l.indexOf("hello"));
}

}