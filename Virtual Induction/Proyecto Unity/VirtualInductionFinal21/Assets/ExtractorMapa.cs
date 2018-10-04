using System.Collections;
using UnityEngine;

public class ExtractorMapa : MonoBehaviour {

    private string msgError = "";
    private bool hayError = false;
    private bool mostrarMap = false;
    private WWW www;
    private Rect rectangulo = new Rect(Screen.width / 3, Screen.height / 3, Screen.width, Screen.width);
    

    // Use this for initialization
    void Start () {

        StartCoroutine(getImage());

    }

    IEnumerator getImage() {

        // Start a download of the given URL
        msgError = "Cargando Mapa";
        string url;
        url = Scenes.getParam("mapa");

        string[] items;
        items = url.Split('|');

        www = new WWW(items[0]);

        // Wait for download to complete
        yield return www;

        if (www.error != null)
        {
            Debug.Log("Error en mapa recibido");
            Debug.Log(items[0]);
            msgError = System.Environment.NewLine + System.Environment.NewLine + "ERROR EN LINK MAPA" + System.Environment.NewLine + "Informar al administrador" + System.Environment.NewLine + "ID_IMAGEN=" + items[1];
            hayError = true;
            StartCoroutine(getImage());
        }
        else {
            hayError = false;
            mostrarMap = true;
            StartCoroutine(Esperar());
            // assign texture
            //Renderer renderer = GetComponent<Renderer>();
            //renderer.material.mainTexture = www.texture;
        }
    }

    void OnGUI()
    {

        if (hayError || !mostrarMap)
        {
            GUI.enabled = true;
            GUI.Box(new Rect(0, Screen.height / 3, Screen.width, Screen.height / 3), msgError);
        }
        else
        {
            GUI.enabled = false;
            if (mostrarMap) {
                GUI.color = Color.white;
                float div = (float)4.5;
                GUI.Label(new Rect(0, Screen.height / div, Screen.width, Screen.width), www.texture);
                GUI.Label(new Rect(0, Screen.height / div, Screen.width, Screen.width), www.texture);
                GUI.Label(new Rect(0, Screen.height / div, Screen.width, Screen.width), www.texture);
            }
            
        }
    }

    IEnumerator Esperar()
    {
        yield return www;
        System.Threading.Thread.Sleep(6000);
        Scenes.Load("Escaneo");
    }

}
