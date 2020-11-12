#include "material.h"
#include "texture.h"
#include "application.h"
#include "extra/hdre.h"

StandardMaterial::StandardMaterial()
{
	color = vec4(1.f, 1.f, 1.f, 1.f);
	shader = Shader::Get("data/shaders/basic.vs", "data/shaders/flat.fs");
}

StandardMaterial::~StandardMaterial()
{

}

void StandardMaterial::setUniforms(Camera* camera, Matrix44 model)
{
	//upload node uniforms
	shader->setUniform("u_viewprojection", camera->viewprojection_matrix);
	shader->setUniform("u_camera_position", camera->eye);
	shader->setUniform("u_model", model);

	shader->setUniform("u_color", color);

	if (texture)
		shader->setUniform("u_texture", texture);
}

void StandardMaterial::render(Mesh* mesh, Matrix44 model, Camera* camera)
{
	if (mesh && shader)
	{
		//enable shader
		shader->enable();

		//upload uniforms
		setUniforms(camera, model);

		//do the draw call
		mesh->render(GL_TRIANGLES);

		//disable shader
		shader->disable();
	}
}

void StandardMaterial::renderInMenu()
{
	ImGui::ColorEdit3("Color", (float*)&color); // Edit 3 floats representing a color
}



WireframeMaterial::WireframeMaterial()
{
	color = vec4(1.f, 1.f, 1.f, 1.f);
	shader = Shader::Get("data/shaders/basic.vs", "data/shaders/flat.fs");
}

WireframeMaterial::~WireframeMaterial()
{

}

void WireframeMaterial::render(Mesh* mesh, Matrix44 model, Camera * camera)
{
	if (shader && mesh)
	{
		glPolygonMode(GL_FRONT_AND_BACK, GL_LINE);

		//enable shader
		shader->enable();

		//upload material specific uniforms
		setUniforms(camera, model);

		//do the draw call
		mesh->render(GL_TRIANGLES);

		glPolygonMode(GL_FRONT_AND_BACK, GL_FILL);
	}
}



PhongMaterial::PhongMaterial()
{
	color = vec4(1.f, 1.f, 1.f, 1.f);
	pos_light = vec3(5,15,2);
	ka = vec3(0.7, 0.7, 0.7);
	kd = vec3(0.7, 0.7, 0.7);
	ks = vec3(0.85, 0.85, 0.85);
	ia = vec3(0.3, 0.3, 0.3);
	id = vec3(0.7, 0.7, 0.7);
	is = vec3(1, 1, 1);
	alpha = 20;
	shader = Shader::Get("data/shaders/basic.vs", "data/shaders/phong.fs");

	type = 1;
}
PhongMaterial::~PhongMaterial()
{

}
void PhongMaterial::setUniforms(Camera* camera, Matrix44 model)
{
	//upload node uniforms
	shader->setUniform("u_viewprojection", camera->viewprojection_matrix);
	shader->setUniform("u_camera_position", camera->eye);
	shader->setUniform("u_model", model);

	shader->setUniform("u_color", color);
	shader->setUniform("pos_light", pos_light);
	shader->setUniform("ia", ia);
	shader->setUniform("id", id);
	shader->setUniform("is", is);
	shader->setUniform("ka", ka);
	shader->setUniform("kd", kd);
	shader->setUniform("ks", ks);
	shader->setUniform("alpha", alpha);

	if (texture)
		shader->setUniform("u_texture", texture);
}
void PhongMaterial::renderInMenu()
{
	ImGui::ColorEdit3("Ambient Light", (float*)&ia); // Edit 3 floats representing a color
	ImGui::ColorEdit3("Diffuse Light", (float*)&id); // Edit 3 floats representing a color
	ImGui::ColorEdit3("Specular Light", (float*)&is); // Edit 3 floats representing a color
	ImGui::ColorEdit3("Ambient Reflection", (float*)&ka); // Edit 3 floats representing a color
	ImGui::ColorEdit3("Reflected Diffuse", (float*)&kd); // Edit 3 floats representing a color
	ImGui::ColorEdit3("Reflected Specular", (float*)&ks); // Edit 3 floats representing a color
	ImGui::SliderFloat("Factor of Shininess", &alpha, float(1.0), float(100));
	ImGui::SliderFloat3("Light Position", &pos_light.x, -100, 100);
}



MirrorMaterial::MirrorMaterial()
{
	color = vec4(1.f, 1.f, 1.f, 1.f);
	shader = Shader::Get("data/shaders/basic.vs", "data/shaders/mirror.fs");

	type = 2;
}
MirrorMaterial::~MirrorMaterial()
{

}
void MirrorMaterial::setUniforms(Camera* camera, Matrix44 model)
{
	//upload node uniforms
	shader->setUniform("u_viewprojection", camera->viewprojection_matrix);
	shader->setUniform("u_camera_position", camera->eye);
	shader->setUniform("u_model", model);

	shader->setUniform("u_color", color);

	if (texture)
		shader->setUniform("u_texture", texture);

	shader->setUniform("u_tone", tone);
	shader->setUniform("u_gamma", gamma);
}
void MirrorMaterial::renderInMenu()
{
	ImGui::Checkbox("Tone-mapping", &tone);
	ImGui::Checkbox("Gamma correction", &gamma);
}


PBRMaterial::PBRMaterial()
{
	color = vec4(1.f, 0.f, 0.f, 1.f);
	shader = Shader::Get("data/shaders/basic.vs", "data/shaders/pbr.fs");
	pos_light = vec3(5, 15, 2);
	rough_factor = 1.0;
	metal_factor = 1.0;

}
PBRMaterial::~PBRMaterial()
{

}
void PBRMaterial::setTextures(int model) {

	texture = new Texture();
	texture->createCubemap(environment->width, environment->height, (Uint8**)environment->getFaces(0));
	
	for (int i = 0; i < 5; i++) {

		HDRE_faces[i] = new Texture();
		sHDRELevel level = environment->getLevel(i);
		HDRE_faces[i]->createCubemap(level.width, level.height, (Uint8**)level.faces);
	}

	brdf = new Texture();
	brdf->load("data/textures/brdfLUT.png");

	albedo_map = new Texture();
	rough_map = new Texture();
	metal_map = new Texture();
	normal_map = new Texture();
	albedo_map = new Texture();
	//opacity_map = new Texture();

	switch (model) {

		case 1: //Ball model
			albedo_map->load("data/textures/ball/albedo.png");
			rough_map->load("data/textures/ball/roughness.png");
			metal_map->load("data/textures/ball/metalness.png");
			normal_map->load("data/textures/ball/normal.png");
			//opacity_map->load("data/textures/ball/opacity.png");
			type = 3;
			break;

		case 2: //Bench model
			albedo_map->load("data/textures/bench/albedo.png");
			rough_map->load("data/textures/bench/roughness.png");
			metal_map->load("data/textures/bench/metalness.png");
			normal_map->load("data/textures/bench/normal.png");
			//opacity_map->load("data/textures/bench/opacity.png");
			type = 4;
			break;

		case 3: //Lantern model
			albedo_map->load("data/textures/lantern/albedo.png");
			rough_map->load("data/textures/lantern/roughness.png");
			metal_map->load("data/textures/lantern/metalness.png");
			normal_map->load("data/textures/lantern/normal.png");
			//opacity_map->load("data/textures/lantern/opacity.png");
			type = 5;
			break;
	}
}
void PBRMaterial::setUniforms(Camera* camera, Matrix44 model)
{
	//upload node uniforms
	shader->setUniform("u_viewprojection", camera->viewprojection_matrix);
	shader->setUniform("u_camera_position", camera->eye);
	if (type == 4) {
		model.scale(3, 3, 3);
	}
	else if (type == 5) {
		model.scale(0.1, 0.1, 0.1);
	}
	shader->setUniform("u_model", model);
	shader->setUniform("u_color", color);

	shader->setUniform("pos_light", pos_light);

	shader->setUniform("u_texture", texture, 1);
	shader->setUniform("u_texture_prem_0", HDRE_faces[0], 2);
	shader->setUniform("u_texture_prem_1", HDRE_faces[1], 3);
	shader->setUniform("u_texture_prem_2", HDRE_faces[2], 4);
	shader->setUniform("u_texture_prem_3", HDRE_faces[3], 5);
	shader->setUniform("u_texture_prem_4", HDRE_faces[4], 6);

	shader->setUniform("u_rough", rough_factor);
	shader->setUniform("u_metal", metal_factor);

	shader->setUniform("u_albedo_map", albedo_map, 7);
	shader->setUniform("u_rough_map", rough_map, 8);
	shader->setUniform("u_metal_map", metal_map, 9);
	shader->setUniform("u_normal_map", normal_map, 10);
	shader->setUniform("u_brdf", brdf, 11);

	shader->setUniform("u_tone", tone);
	shader->setUniform("u_gamma", gamma);

	//shader->setUniform("u_opacity", opacity_map, 12);

}
void PBRMaterial::renderInMenu()
{
	ImGui::SliderFloat("Roughness Factor", &rough_factor, float(0.01), float(1.0));
	ImGui::SliderFloat("Metallic Factor", &metal_factor, float(0.01), float(1.0));
	ImGui::Checkbox("Tone-mapping", &tone);
	ImGui::Checkbox("Gamma correction", &gamma);
}
