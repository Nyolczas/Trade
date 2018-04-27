public class FileOperations {
    public static void main (String[] args){

        /*
        // ez egy .txt reader
        fileRead r = new fileRead();
        r.openFile();
        r.readFile();
        r.closeFile();

        */

        // ez egy .csv reader
        csvFileRead cs = new csvFileRead();
        cs.csvReadTest();
    }
}
