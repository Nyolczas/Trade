import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.List;

public class ReadCsvYo {
    public static void main(String[] args){

        try {

            List<String> lines = Files.readAllLines(Paths.get("AUDUSD_M5_Zoom.csv"));

            for (String line : lines) {
                String[] result = line.split(";");
                for(String s : result) {
                    System.out.print(s + " ### ");
                }
                System.out.println();
            }

        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }
}
