using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Interaction : MonoBehaviour
{

    public Interact focus;
    public bool canJump = false;
    public int countMemories = 0;

    //This function is going to send triffer events
    private void OnTriggerEnter(Collider col)
    {
        //If the character collides, will interact
        Interact interact = col.GetComponent<Interact>();
        SetFocus(interact);
    }


    public void SetFocus(Interact newFocus)
    {
        focus = newFocus;
        focus.OnFocused(transform);

    }

    public void RemoveFocus()
    {
        focus = null;

    }
}

