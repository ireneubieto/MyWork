using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class camController : MonoBehaviour
{

    public enum CameraMode
    {
        normal, focus, lockedPosition, freezeRotation
    };

    public CharacterController player;

    public float rotateSpeed = 5;
    public float damping = 1;
    Vector3 offset;

    Vector3 offsetX, offsetY;

    public float height = 1f;
    public float distance = 2f;

    public float turnSpeed = 4.0f;

    [Range(1.0f, 50f)]
    public float lerpSpeed = 8f;
    float mouseY, mouseX;
    public float mouseSensitivity = 2.5f;
    public float minY = -70f;
    public float maxY = 70f;
    private float desiredDistance = 20;
    private float actualDistance = 20;
    private float cameraDistance = 4;
    private Quaternion desiredRotation;
    private Vector3 desiredPosition;
    private bool colliding;
    private float yDisp;

    public float yDisplacementMultiplier = 2f;
    public float xOffset = 0;
    CameraMode cameraMode;

    private Vector3 targetToCamera;
    public LayerMask collideWith;

    public AnimationCurve yDisplacement;
    public float cameraHeight = 4;

    void Start()
    {
        offset = transform.position - player.transform.position;

        offsetX = new Vector3(0, height, distance);
        offsetY = new Vector3(0, 0, distance);
        //FreezeAndShowCursor(false);
    }

/*
    private void Update()
    {
        if (Input.GetKeyDown(KeyCode.M)) //DEBUG
        {
            if (cameraMode == CameraMode.freezeRotation)
            {
                FreezeAndShowCursor(false);
            }
            else
            {
                FreezeAndShowCursor(true);
            }
        }
    }*/


    /*public void FreezeAndShowCursor(bool freezeAndShow)
    {
        if (freezeAndShow)
        {
            Cursor.lockState = CursorLockMode.None;
            Cursor.visible = true;
            cameraMode = CameraMode.freezeRotation;

        }
        else
        {
            Cursor.lockState = CursorLockMode.Locked;
            Cursor.visible = false;
            cameraMode = CameraMode.normal;
        }
    }*/



    void FixedUpdate()
    {
        //Vector3 desiredPosition = player.transform.position + offset;
        //transform.position = desiredPosition;

        //       transform.LookAt(player.transform);

        //float x = Input.GetAxis("Mouse X");
        //transform.Translate(Vector3.right * x);



        if(cameraMode == CameraMode.normal)
        {
            Vector2 input = new Vector2(Input.GetAxis("Mouse X"), Input.GetAxis("Mouse Y"));

            float inputThreshold = 0f; //for deadzone

            if (Mathf.Abs(input.y) > inputThreshold)
            {
                mouseY -= input.y * mouseSensitivity;
                mouseY = Mathf.Clamp(mouseY, minY, maxY);
            }

            if (Mathf.Abs(input.x) > inputThreshold)
            {
                mouseX += input.x * mouseSensitivity;
            }

            desiredDistance = Mathf.Lerp(desiredDistance, distance, 2f);
            actualDistance = Mathf.Clamp(desiredDistance, 0, desiredDistance - CollisionCheck());

            /*if (!colliding)
            {
                yDisp = yDisplacement.Evaluate(1 - ((mouseY + maxY) / (maxY - minY))) * yDisplacementMultiplier;
                actualDistance -= yDisp;
            }*/

            cameraDistance = Mathf.Lerp(cameraDistance, actualDistance, Time.deltaTime * lerpSpeed * 10);
            desiredRotation = Quaternion.Euler(mouseY, mouseX, 0);
            desiredPosition = desiredRotation * (new Vector3(xOffset, 0.0f, -cameraDistance)) + (player.transform.position + Vector3.up * cameraHeight);

            //  transform.position = desiredPosition;
            //  transform.rotation = desiredRotation;

            transform.position = Vector3.Lerp(transform.position, desiredPosition, lerpSpeed * Time.deltaTime);
            transform.rotation = Quaternion.Lerp(transform.rotation, desiredRotation, lerpSpeed * Time.deltaTime);
        }



        


        //offset = Quaternion.AngleAxis(Input.GetAxis("Mouse X") * turnSpeed, Vector3.up) * offset;

        //offsetX = Quaternion.AngleAxis(Input.GetAxis("Mouse X") * turnSpeed, Vector3.up) * offsetX;
        //offsetY = Quaternion.AngleAxis(Input.GetAxis("Mouse Y") * turnSpeed, Vector3.right) * offsetY;
        //transform.position = player.transform.position + offsetX;
        //transform.LookAt(player.transform.position);

        //offset = transform.position - player.transform.position;

    }


    RaycastHit hit;
    private float CollisionCheck()
    {
        if (player != null)
        {
            targetToCamera = transform.position - player.transform.position;

            if (Physics.Raycast(player.transform.position, targetToCamera.normalized, out hit, desiredDistance - yDisp, collideWith))
            {
                colliding = true;
                return desiredDistance - hit.distance + 0.5f;
            }
        }

        colliding = false;
        return 0;
    }



}