# Physically Based Rendering

## Main Concept

In this project I tried to generate synthetic images as similar as possible to real images by producing them on the basis of the closest possible simulation of the light behaviour. For this, I implemented a PBR (Physically Based Rendering) renderer which would represent materials and how they interact with light. The materials were Phong material, Reflective material and PBR material.
I created a pixel shader for each material.

### Phong Material

In the Phong shader, basically the Phong light equation was computed by using the ambient, diffuse and specular light and computing the light vector, the normal vector of the point, the eye position vector and the reflection of the light over the normal.

<img src="https://github.com/ireneubieto/MyWork/blob/main/ComputerGraphics/PhysicallyBasedRendering/Images/Phong.png" alt="Phong result" width="500px">
<img src="https://github.com/ireneubieto/MyWork/blob/main/ComputerGraphics/PhysicallyBasedRendering/Images/PhongGUI.png" alt="Phong GUI" width="500px">

The shininess of the material can be changed:
<img src="https://github.com/ireneubieto/MyWork/blob/main/ComputerGraphics/PhysicallyBasedRendering/Images/PhongShine.png" alt="Phong shininess changes" width="500px">

### Reflective Material

For the reflective material I created a cubemap texture from an HDRE 3D environment. The HDRE texture consists on several exposures of an image
combined together, so we can capture the whole environment. The idea is that we will have our reflective sphere inside a cube which has the texture in each
wall (our cubemap, centered on the camera eye), in a way that our sphere is going to reflect the texture.

I also applied two variables to make it possible for us to decide if we want to use tone-mapping, gamma correction (or both).

Then, in the shader, I made the ball reflect the cubemap texture.

<img src="https://github.com/ireneubieto/MyWork/blob/main/ComputerGraphics/PhysicallyBasedRendering/Images/Mirror.png" alt="Reflective result" width="500px">
<img src="https://github.com/ireneubieto/MyWork/blob/main/ComputerGraphics/PhysicallyBasedRendering/Images/MirrorGUI.png" alt="Reflective GUI" width="500px">

In the following images we can see the result of the use of the tone-mapping and the gamma
correction, respectively.

<img src="https://github.com/ireneubieto/MyWork/blob/main/ComputerGraphics/PhysicallyBasedRendering/Images/MirrorToneOrGamma.png" alt="Tone-Mapping and Gamma Correction" width="500px">

And, finally, this is the result if we use both the tone-mapping and the gamma correction.

<img src="https://github.com/ireneubieto/MyWork/blob/main/ComputerGraphics/PhysicallyBasedRendering/Images/MirrorToneAndGamma.png" alt="Tone-Mapping + Gamma Correction" width="500px">

### PBR Material

For the PBR, the final color of every pixel will be the addition of the environment light and puctual light. For that we will compute the material properties and then, the equations to obtain the final color of the pixel.

<img src="https://github.com/ireneubieto/MyWork/blob/main/ComputerGraphics/PhysicallyBasedRendering/Images/PBR.png" alt="PBR result" width="500px">
<img src="https://github.com/ireneubieto/MyWork/blob/main/ComputerGraphics/PhysicallyBasedRendering/Images/PBRGUI.png" alt="PBR GUI" width="500px">

This is the result of changing the roughness and metallic factors values

<img src="https://github.com/ireneubieto/MyWork/blob/main/ComputerGraphics/PhysicallyBasedRendering/Images/PBRRoughAndMetal.png" alt="Change of roughness and metallic factors" width="500px">

In the following images we can see the result of the use of the tone-mapping and the gamma
correction, respectively.

<img src="https://github.com/ireneubieto/MyWork/blob/main/ComputerGraphics/PhysicallyBasedRendering/Images/PBRToneOrGamma.png" alt="Tone-Mapping and Gamma Correction" width="500px">

And, finally, this is the result if we use both the tone-mapping and the gamma correction.

<img src="https://github.com/ireneubieto/MyWork/blob/main/ComputerGraphics/PhysicallyBasedRendering/Images/PBRToneAndGamma.png" alt="Tone-Mapping + Gamma Correction" width="500px">

## Engine

This project was developed in C++ and OpenGL. It was done for the UPF course Advanced Visualization.

## Contributions

**Developers:** Irene Ubieto Alamillo

**Framework Developer:** Javi Agenjo

**Assistance:** Miquel Floriach Clark, Alejandro Rodríguez Corrales


