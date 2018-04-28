import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.List;

public class csvFileRead {
    public float[] hozam;
    public void csvReadTest(){
        try {
            List<String> lines = Files.readAllLines(Paths.get("AUDUSD_M5_Zoom.csv"));

            // ellenőrző logolás
            for (String line : lines) {
                String[] result = line.split(";");
                for(String s : result) {
                    System.out.print(s + " ### ");
                }
                System.out.println();
            }
            System.out.println();

            // darabszám kiderítése:
            int db =lines.size();
            System.out.println("A lista " + db + " darab bejegyzést tartalmazott.");
            System.out.println();


            // a profitok hozzáadása a hozam tömbhöz
            float temphozam = 0;

            for(int i = 1; i < db; i++){
                String[] result = lines.get(i).split(";");
                temphozam += Float.parseFloat(result[6]);
                hozam[i] = temphozam;
                System.out.println(result[6] + " hozam: " + hozam[i]);
            }

        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }
}
