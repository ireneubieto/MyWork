using UnityEngine;

public class Interact : MonoBehaviour
{

    public float radius = 2f;

    bool isFocus = false;
    bool hasInteracted = false;
    Transform player;
    public float distance;

    public GameObject MessagePanel;
    GameObject MemoryClose;
    public GameObject MemoryPicture;
    public GameObject MemoryGUI;

    void Memory_Interact()
    {
        OpenMessagePanel(MemoryPicture);
        MemoryClose = MemoryPicture;
        OpenMessagePanel(MemoryGUI);
    }

    void Skill_Interact()
    {
        Interaction interaction = player.GetComponent<Interaction>();
        interaction.canJump = true;
        
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
        Interaction interaction = player.GetComponent<Interaction>();
        interaction.countMemories += 1;
        OnDefocused();
        transform.GetComponent<Renderer>().enabled = false;
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
