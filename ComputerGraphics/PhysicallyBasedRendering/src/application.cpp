#include "application.h"
#include "utils.h"
#include "mesh.h"
#include "texture.h"
#include "volume.h"
#include "fbo.h"
#include "shader.h"
#include "input.h"
#include "animation.h"
#include "extra/hdre.h"
#include "includes.h"

#include <cmath>

Application* Application::instance = NULL;
Camera* Application::camera = nullptr;

Application::Application(int window_width, int window_height, SDL_Window* window)
{
	this->window_width = window_width;
	this->window_height = window_height;
	this->window = window;
	instance = this;
	must_exit = false;
	render_debug = true;
	render_wireframe = false;

	fps = 0;
	frame = 0;
	time = 0.0f;
	elapsed_time = 0.0f;
	mouse_locked = false;

	typeMaterial = 3;

	// OpenGL flags
	glEnable( GL_CULL_FACE ); //render both sides of every triangle
	glEnable( GL_DEPTH_TEST ); //check the occlusions using the Z buffer

	// Create camera
	camera = new Camera();
	camera->lookAt(Vector3(15.f, 15.0f, 25.f), Vector3(0.f, 0.0f, 0.f), Vector3(0.f, 1.f, 0.f));
	camera->setPerspective(45.f,window_width/(float)window_height,0.1f,10000.f);

	/*******/
	/*PHONG*/
	/*******/

	// Create scene node (phong)
	SceneNode * node_phong = new SceneNode("Phong Ball");
	root.push_back(node_phong);
	// Set mesh and manipulate model matrix
	node_phong->mesh = Mesh::Get("data/meshes/sphere.obj.mbin");
	// Create node material PHONG
	PhongMaterial * phong_material = new PhongMaterial();
	node_phong->material = phong_material;

	/********/
	/*MIRROR*/
	/********/

	// Create scene node 2 (mirror)
	SceneNode * node_mirror = new SceneNode("Mirror Ball");
	root.push_back(node_mirror);
	// Set mesh and manipulate model matrix
	node_mirror->mesh = Mesh::Get("data/meshes/sphere.obj.mbin");
	// Create node material MIRROR
	MirrorMaterial * mirror_material = new MirrorMaterial();
	node_mirror->material = mirror_material;
	
	//We get the texture from HDRE
	HDRE * hdre = new HDRE("data/environments/environment.hdre");
	Texture* cubemapTex = new Texture();
	cubemapTex->createCubemap(hdre->width, hdre->height, (Uint8**)hdre->getFaces(0));

	mirror_material->texture = cubemapTex;

	/**********/
	/*PBR BALL*/
	/**********/
	SceneNode * node_PBR_1 = new SceneNode("PBR Ball");
	root.push_back(node_PBR_1);
	// Set mesh and manipulate model matrix
	node_PBR_1->mesh = Mesh::Get("data/meshes/sphere.obj.mbin");
	// Create node material MIRROR
	PBRMaterial * PBR_material_1 = new PBRMaterial();
	node_PBR_1->material = PBR_material_1;

	//We get the texture from HDRE
	HDRE * environment = new HDRE("data/environments/environment.hdre");
	PBR_material_1->environment = environment;
	PBR_material_1->setTextures(1);

	/***********/
	/*PBR BENCH*/
	/***********/
	SceneNode * node_PBR_2 = new SceneNode("PBR Bench");
	root.push_back(node_PBR_2);
	// Set mesh and manipulate model matrix
	node_PBR_2->mesh = Mesh::Get("data/meshes/bench.obj.mbin");
	// Create node material MIRROR
	PBRMaterial * PBR_material_2 = new PBRMaterial();
	node_PBR_2->material = PBR_material_2;

	//We get the texture from HDRE
	PBR_material_2->environment = environment;
	PBR_material_2->setTextures(2);

	/*************/
	/*PBR LANTERN*/
	/*************/
	SceneNode * node_PBR_3 = new SceneNode("PBR Lantern");
	root.push_back(node_PBR_3);
	// Set mesh and manipulate model matrix
	node_PBR_3->mesh = Mesh::Get("data/meshes/lantern.obj");
	// Create node material MIRROR
	PBRMaterial * PBR_material_3 = new PBRMaterial();
	node_PBR_3->material = PBR_material_3;

	//We get the texture from HDRE
	PBR_material_3->environment = environment;
	PBR_material_3->setTextures(3);



	//hide the cursor
	SDL_ShowCursor(!mouse_locked); //hide or show the mouse
}

//what to do when the image has to be draw
void Application::render(void)
{
	//set the clear color (the background color)
	glClearColor(0.0, 0.0, 0.0, 1.0);

	// Clear the window and the depth buffer
	glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);

	//set the camera as default
	camera->enable();

	//set flags
	glDisable(GL_BLEND);
	glEnable(GL_DEPTH_TEST);
	glDisable(GL_CULL_FACE);

	for (int i = 0; i < root.size(); i++) {
		if (root[i]->material->type == typeMaterial) {
			root[i]->render(camera);
		}

		if(render_wireframe)
			root[i]->renderWireframe(camera);
	}

	//Draw the floor grid
	if(render_debug)
		drawGrid();
}

void Application::update(double seconds_elapsed)
{
	float speed = seconds_elapsed * 10; //the speed is defined by the seconds_elapsed so it goes constant
	float orbit_speed = seconds_elapsed * 0.5;
	
	//example
	float angle = (float)seconds_elapsed * 10.0f*DEG2RAD;
	for (int i = 0; i < root.size(); i++) {
		//root[i]->model.rotate(angle, Vector3(0,1,0));
	}

	//mouse input to rotate the cam
	if ((Input::mouse_state & SDL_BUTTON_LEFT && !ImGui::IsAnyWindowHovered() 
		&& !ImGui::IsAnyItemHovered() && !ImGui::IsAnyItemActive())) //is left button pressed?
	{
		camera->orbit(-Input::mouse_delta.x * orbit_speed, Input::mouse_delta.y * orbit_speed);
	}

	//async input to move the camera around
	if (Input::isKeyPressed(SDL_SCANCODE_LSHIFT)) speed *= 10; //move faster with left shift
	if (Input::isKeyPressed(SDL_SCANCODE_W) || Input::isKeyPressed(SDL_SCANCODE_UP)) camera->move(Vector3(0.0f, 0.0f, 1.0f) * speed);
	if (Input::isKeyPressed(SDL_SCANCODE_S) || Input::isKeyPressed(SDL_SCANCODE_DOWN)) camera->move(Vector3(0.0f, 0.0f,-1.0f) * speed);
	if (Input::isKeyPressed(SDL_SCANCODE_A) || Input::isKeyPressed(SDL_SCANCODE_LEFT)) camera->move(Vector3(1.0f, 0.0f, 0.0f) * speed);
	if (Input::isKeyPressed(SDL_SCANCODE_D) || Input::isKeyPressed(SDL_SCANCODE_RIGHT)) camera->move(Vector3(-1.0f, 0.0f, 0.0f) * speed);
	if (Input::isKeyPressed(SDL_SCANCODE_SPACE)) camera->moveGlobal(Vector3(0.0f, -1.0f, 0.0f) * speed);
	if (Input::isKeyPressed(SDL_SCANCODE_LCTRL)) camera->moveGlobal(Vector3(0.0f,  1.0f, 0.0f) * speed);

	//to navigate with the mouse fixed in the middle
	if (mouse_locked)
		Input::centerMouse();
}

//Keyboard event handler (sync input)
void Application::onKeyDown( SDL_KeyboardEvent event )
{
	switch(event.keysym.sym)
	{
		case SDLK_ESCAPE: must_exit = true; break; //ESC key, kill the app
		case SDLK_F1: render_debug = !render_debug; break;
		case SDLK_F5: Shader::ReloadAll(); break; 
	}
}

void Application::onKeyUp(SDL_KeyboardEvent event)
{
}

void Application::onGamepadButtonDown(SDL_JoyButtonEvent event)
{

}

void Application::onGamepadButtonUp(SDL_JoyButtonEvent event)
{

}

void Application::onMouseButtonDown( SDL_MouseButtonEvent event )
{
	if (event.button == SDL_BUTTON_MIDDLE) //middle mouse
	{
		mouse_locked = !mouse_locked;
		SDL_ShowCursor(!mouse_locked);
	}
}

void Application::onMouseButtonUp(SDL_MouseButtonEvent event)
{
}

void Application::onMouseWheel(SDL_MouseWheelEvent event)
{
	ImGuiIO& io = ImGui::GetIO();
	switch (event.type)
	{
		case SDL_MOUSEWHEEL:
		{
			if (event.x > 0) io.MouseWheelH += 1;
			if (event.x < 0) io.MouseWheelH -= 1;
			if (event.y > 0) io.MouseWheel += 1;
			if (event.y < 0) io.MouseWheel -= 1;
		}
	}

	if(!ImGui::IsAnyWindowHovered() && event.y)
		camera->changeDistance(event.y * 0.5);
}

void Application::onResize(int width, int height)
{
    std::cout << "window resized: " << width << "," << height << std::endl;
	glViewport( 0,0, width, height );
	camera->aspect =  width / (float)height;
	window_width = width;
	window_height = height;
}

