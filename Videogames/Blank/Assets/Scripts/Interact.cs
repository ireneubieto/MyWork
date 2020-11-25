using UnityEngine;

public class Interact : MonoBehaviour
{

    public float radius = 2f;

    bool isFocus = false;
    bool hasInteracted = false;
    Transform player;
    public float distance;
    public AudioClip PickupSound;
    public AudioSource audio;

    public GameObject MessagePanel;
    GameObject MemoryClose;
    GameObject SkillClose;
    public GameObject Picture;
    public GameObject InfoGUI;

    private float timeToAppear = 2f;
    private float timeWhenDisappear;
    bool isActive = false;


    private void Start()
    {
        
    }

    void Memory_Interact()
    {
        OpenMessagePanel(Picture);
        MemoryClose = Picture;
        OpenMessagePanel(InfoGUI);
        AudioSource.PlayClipAtPoint(PickupSound, transform.position);
    }

    void Skill_Interact()
    {
        Interaction interaction = player.GetComponent<Interaction>();
        interaction.canJump = true;

        SkillClose = Picture;
        OpenMessagePanel(Picture);
        isActive = true;
        timeWhenDisappear = Time.time + timeToAppear;

        OpenMessagePanel(InfoGUI);
        AudioSource.PlayClipAtPoint(PickupSound, transform.position);
    }

   

    void Update()
    {
        if (isFocus)
        {
            distance = Vector3.Distance(player.position, transform.position);

            if (transform.tag == "Memory")
            {
                if (Input.GetKeyDown(KeyCode.G))
                {
                    if (hasInteracted == false)
                    {
                        //Has interacted
                        Memory_Interact();
                        hasInteracted = true;
                        
                    }
                    else if (hasInteracted == true)
                    {
                        CloseMessagePanel(MemoryClose);
                        Interaction interaction = player.GetComponent<Interaction>();
                        interaction.countMemories += 1;
                        hasCollected();
                    }
                }
                else if (distance > radius && hasInteracted == false)
                {
                    //Only the panel will disappear
                    OnDefocused();
                }
            }
            else if (transform.tag == "Skill")
            {
                if (Input.GetKey(KeyCode.G))
                {
                    //Has interacted
                    Skill_Interact();
                    hasInteracted = true;
                    hasCollected();
                }
                else if (distance > radius && hasInteracted == false)
                {
                    //Only the panel will disappear
                    OnDefocused();
                }
            }

        }
        if (isActive && (Time.time >= timeWhenDisappear))
        {
            CloseMessagePanel(SkillClose);
            isActive = false;
        }
    }

    public void OnFocused (Transform playerTransform)
    {
        isFocus = true;
        player = playerTransform;
        OpenMessagePanel(MessagePanel);
    }

    public void OnDefocused()
    {
        Interaction interaction = player.GetComponent<Interaction>();
        interaction.RemoveFocus();
        isFocus = false;
        player = null;
        CloseMessagePanel(MessagePanel);
    }

    public void hasCollected()
    {
        transform.GetComponent<Renderer>().enabled = false;
        OnDefocused();
        MessagePanel = null;
    }

    public void OpenMessagePanel(GameObject Panel)
    {

         Panel.SetActive(true);

    }

    public void CloseMessagePanel(GameObject Panel)
    {

        Panel.SetActive(false);

    }
    
}
