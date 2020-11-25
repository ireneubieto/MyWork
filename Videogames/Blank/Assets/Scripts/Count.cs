using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Count : MonoBehaviour
{
    public GameObject count_0;
    public GameObject count_1;
    public GameObject count_2;
    public GameObject count_3;
    public GameObject count_4;
    public GameObject count_5;

    public GameObject player;

    // Update is called once per frame
    void Update()
    {
        Interaction interaction = player.GetComponent<Interaction>();

        if (interaction.countMemories == 0)
        {
            count_0.SetActive(true);
        }
        else if (interaction.countMemories == 1)
        {
            count_0.SetActive(false);
            count_1.SetActive(true);
        }
        else if (interaction.countMemories == 2)
        {
            count_0.SetActive(false);
            count_1.SetActive(false);
            count_2.SetActive(true);
        }
        else if (interaction.countMemories == 3)
        {
            count_0.SetActive(false);
            count_1.SetActive(false);
            count_2.SetActive(false);
            count_3.SetActive(true);
        }
        else if (interaction.countMemories == 4)
        {
            count_0.SetActive(false);
            count_1.SetActive(false);
            count_2.SetActive(false);
            count_3.SetActive(false);
            count_4.SetActive(true);
        }
        else if (interaction.countMemories == 5)
        {
            count_0.SetActive(false);
            count_1.SetActive(false);
            count_2.SetActive(false);
            count_3.SetActive(false);
            count_4.SetActive(false);
            count_5.SetActive(true);
        }
    }
}
