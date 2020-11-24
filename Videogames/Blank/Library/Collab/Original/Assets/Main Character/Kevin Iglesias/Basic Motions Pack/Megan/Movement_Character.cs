using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Movement_Character : MonoBehaviour
{
    float speed = 4;
    float rotSpeed = 80;
    float rot = 0f;
    float gravity = 8;
    int currentCondition;

    Vector3 moveDir = Vector3.zero;
  

    CharacterController controller;
    Animator anim; 

    // Start is called before the first frame update
    void Start()
    {
        controller = GetComponent<CharacterController>();
        anim = GetComponent<Animator>(); 
        
    }

    // Update is called once per frame
    void Update()
    {
        MovementF();
        //MovementB();

        //Debug.Log("ConditionIdleWalk: " + currentCondition);
     }

    void MovementF()
    {
        if (controller.isGrounded)
        {
           anim.SetInteger("ConditionIdleWalk", 0);
            currentCondition = 0;
           anim.SetBool("WalkingForward", false);
           //anim.SetBool("WalkingBackward", false);
            moveDir = new Vector3(0.0f, 0.0f, 0.0f);

            if (Input.GetKey(KeyCode.W))
            {
                anim.SetBool("WalkingForward", true);
                anim.SetInteger("ConditionIdleWalk", 1);
                currentCondition = 1;
                moveDir = new Vector3(0.0f, 0.0f, 1.0f);
                moveDir *= speed;
                moveDir = transform.TransformDirection(moveDir);
            

                if (Input.GetKey(KeyCode.LeftShift))
                {
                    anim.SetBool("WalkingForward", true);
                    anim.SetInteger("ConditionIdleWalk", 3);
                    currentCondition = 3;
                    moveDir = new Vector3(0.0f, 0.0f, 1.0f);
                    moveDir *= speed * 2;
                    moveDir = transform.TransformDirection(moveDir);

                }
                
            
            }
            /*
            if (Input.GetKey(KeyCode.A))
            {
                anim.SetBool("WalkingForward", true);
                anim.SetInteger("ConditionIdleWalk", 1);
                currentCondition = 1;
                moveDir = new Vector3(-1.0f, 0.0f, 0.0f);
                moveDir *= speed;
                moveDir = transform.TransformDirection(moveDir);
            }
            if (Input.GetKey(KeyCode.D))
            {
                anim.SetBool("WalkingForward", true);
                anim.SetInteger("ConditionIdleWalk", 1);
                currentCondition = 1;
                moveDir = new Vector3(1.0f, 0.0f, 0.0f);
                moveDir *= speed;
                moveDir = transform.TransformDirection(moveDir);
            }
            */

            if (Input.GetKey(KeyCode.S))
            {
                anim.SetBool("WalkingForward", true);
                anim.SetInteger("ConditionIdleWalk", 2);
                currentCondition = 2;
                moveDir = new Vector3(0.0f, 0.0f, -1.0f);
                moveDir *= speed;
                moveDir = transform.TransformDirection(moveDir);
            }
            



            Interaction interaction = this.GetComponent<Interaction>();
            if (interaction.canJump == true)
            {

                if (Input.GetKeyDown(KeyCode.Space))
                {
                    
                    //anim.SetBool("WalkingForward", true);
                    anim.SetInteger("ConditionIdleWalk", 4);
                    currentCondition = 4;
                    moveDir = new Vector3(0.0f, 2.0f, 1.0f);
                    moveDir *= speed;
                    moveDir = transform.TransformDirection(moveDir);
                }
            }
           
        }

        rot += Input.GetAxis("Horizontal") * rotSpeed * Time.deltaTime;
        transform.eulerAngles = new Vector3(0.0f, rot, 0.0f);

        moveDir.y -= gravity * Time.deltaTime;
        controller.Move(moveDir * Time.deltaTime);
    }


  


    void MovementB()
    {
        if (controller.isGrounded)
        {
            anim.SetInteger("ConditionIdleWalk", 0);
           // anim.SetBool("WalkingForward", false);
            anim.SetBool("WalkingBackward", false);
            moveDir = new Vector3(0.0f, 0.0f, 0.0f);

            if (Input.GetKey(KeyCode.S))
            {
                anim.SetBool("WalkingForward", true);
                anim.SetInteger("ConditionIdleWalk", 2);
                moveDir = new Vector3(0.0f, 0.0f, -1.0f);
                moveDir *= speed;
                moveDir = transform.TransformDirection(moveDir);
            }


        }

        rot += Input.GetAxis("Horizontal") * rotSpeed * Time.deltaTime;
        transform.eulerAngles = new Vector3(0.0f, rot, 0.0f);

        moveDir.y -= gravity * Time.deltaTime;
        controller.Move(moveDir * Time.deltaTime);
    }

}
