import java.io.*;
import java.nio.file.Path;
import java.util.*;
// Ez ebben a formában csak txt olvasására való
public class fileRead {
    private Scanner x;

    public void openFile(){
        try{
            File file = new File("AUDUSD_M5_Zoom.txt");
            x  = new Scanner(file);
        }
        catch(Exception e) {
            System.out.println("nemtalálom a fájlt vazze!");
        }
    }

    public void readFile(){
        while(x.hasNext()){
            System.out.println(x.next());
        }
    }

    public void closeFile(){
        x.close();
    }
}
