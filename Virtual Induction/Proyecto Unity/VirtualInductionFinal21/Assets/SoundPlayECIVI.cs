using UnityEngine;
using Vuforia;
using System.Collections;

public class SoundPlayECIVI : MonoBehaviour,
                                            ITrackableEventHandler
{
    private string textoSQL;
    private AudioClip clip;
    private string url = "http://estudiantes.is.escuelaing.edu.co/~2092964/SQLphp/ItemsData.php?actividad=";
    private TrackableBehaviour mTrackableBehaviour;
    private string msgError="Cargando...";
    private bool hayErrorBD = false;
    private bool hayErrorMp3 = false;
    private bool hayErrorRed = false;
    private bool cambiarEscena = false;
    private bool canPlay = false;
    private bool tracked;
    public string[] items;
    public string id_imagen = "1";
    private new AudioSource audio;

    void Start()
    {
        StartCoroutine(checkInternetConnection());
        VuforiaBehaviour.Instance.enabled = false;
        Debug.Log("VI Has Starded");
        System.Console.WriteLine("Detectado");

        mTrackableBehaviour = GetComponent<TrackableBehaviour>();

        if (mTrackableBehaviour)
        {
            mTrackableBehaviour.RegisterTrackableEventHandler(this);
        }		
    }

    public void OnTrackableStateChanged(
                                    TrackableBehaviour.Status previousStatus,
                                    TrackableBehaviour.Status newStatus)
    {
        
        if (newStatus == TrackableBehaviour.Status.DETECTED ||
            newStatus == TrackableBehaviour.Status.TRACKED ||
            newStatus == TrackableBehaviour.Status.EXTENDED_TRACKED)
        {
            // Play audio when target is found
            tracked = true;
            if (canPlay)
                StartCoroutine(PlaySound());
            
        }
        else
        {
            // Stop audio when target is lost
            tracked = false;
            if (canPlay) {
                audio.Stop();
            }
            
            
        }
    }


    string GetDataValue(string data, string index) {

        string valor = data.Substring(data.IndexOf(index)+index.Length);
        if(valor.Contains("|"))valor = valor.Remove(valor.IndexOf("|"));
        return valor;

    }


    IEnumerator GetTextFromWWW()
    {
        WWW www = new WWW(url+id_imagen);

        yield return www;

        if (www.error != null)
        {
            Debug.Log("Error en texto recibido de BD");
            msgError = System.Environment.NewLine + System.Environment.NewLine + "ERROR EN LINK PHP BD" + System.Environment.NewLine + "Informar al administrador" + System.Environment.NewLine + "ID_IMAGEN=" + id_imagen;
            hayErrorBD = true;
            StartCoroutine(checkInternetConnection());

        }
        else
        {
            hayErrorBD = false;
            textoSQL = www.text;
            Debug.Log("Loaded Text: " + textoSQL);
            items = textoSQL.Split(';');
            StartCoroutine(GetAudioFromWWW());
        }
    }

    IEnumerator GetAudioFromWWW()
    {

        Debug.Log("Items: " + items[0]);
        WWW www = new WWW(GetDataValue(items[0], "link_mp3:"));

        yield return www;

        if (www.error != null)
        {
            Debug.Log("Error en link de audio");
            msgError = System.Environment.NewLine + System.Environment.NewLine + "NO SE PUEDE CARGAR AUDIO" + System.Environment.NewLine + "Link de mp3 corrupto," + System.Environment.NewLine + "informar al administrador." + System.Environment.NewLine + "ID_IMAGEN=" + id_imagen;
            hayErrorMp3 = true;
            StartCoroutine(checkInternetConnection());
        }
        else
        {
            audio = GetComponent<AudioSource>();
            hayErrorMp3 = false;
            clip = www.GetAudioClip(false, true);
            Debug.Log("Loaded Audio: " + GetDataValue(items[0], "link_mp3:"));
            audio.clip = clip;
            canPlay = true;
            VuforiaBehaviour.Instance.enabled = true;
        }

    }

    IEnumerator checkInternetConnection()
    {
        WWW www = new WWW("http://estudiantes.is.escuelaing.edu.co/");
        yield return www;
        if (www.error != null)
        {
            Debug.Log("Sin conexion a internet");
            msgError = System.Environment.NewLine + System.Environment.NewLine + "NO SE PUEDE CONECTAR A INTERNET" + System.Environment.NewLine + "Compruebe que tiene salida a internet" + System.Environment.NewLine + "y vuelva a iniciar la app," + System.Environment.NewLine + "de lo contrario informe al administrador." + System.Environment.NewLine + "SER";
            hayErrorRed = true;
            StartCoroutine(checkInternetConnection());
        }
        else {
            hayErrorRed = false;
            StartCoroutine(GetTextFromWWW());
        }
    }

    void OnGUI()
    {
        if (hayErrorBD || hayErrorMp3 || hayErrorRed || !canPlay)
        {
            GUI.enabled = true;
            GUI.Box(new Rect(0, Screen.height / 3, Screen.width, Screen.height / 4), msgError);
        }
        else {
            GUI.enabled = false;
        }
    }

    void Update()
    {
        if (cambiarEscena)
        {
            if(!audio.isPlaying)
            Scenes.Load("Mapas", "mapa", GetDataValue(items[0], "link_mapa:") + "|" + id_imagen);
        }
    }

    IEnumerator PlaySound() {

        audio.Play();
        yield return new WaitForSeconds(audio.clip.length+1);
        if (tracked)
            cambiarEscena = true;


    }
}
