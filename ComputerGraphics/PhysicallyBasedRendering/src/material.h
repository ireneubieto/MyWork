#ifndef MATERIAL_H
#define MATERIAL_H

#include "framework.h"
#include "shader.h"
#include "camera.h"
#include "mesh.h"
#include "extra/hdre.h"

class Material {
public:

	Shader* shader = NULL;
	Texture* texture = NULL;
	vec4 color;
	int type;

	virtual void setUniforms(Camera* camera, Matrix44 model) = 0;
	virtual void render(Mesh* mesh, Matrix44 model, Camera * camera) = 0;
	virtual void renderInMenu() = 0;
};

class StandardMaterial : public Material {
public:

	StandardMaterial();
	~StandardMaterial();

	void setUniforms(Camera* camera, Matrix44 model);
	void render(Mesh* mesh, Matrix44 model, Camera * camera);
	void renderInMenu();
};

class WireframeMaterial : public StandardMaterial {
public:

	WireframeMaterial();
	~WireframeMaterial();

	void render(Mesh* mesh, Matrix44 model, Camera * camera);
};

class PhongMaterial : public StandardMaterial {
public:

	PhongMaterial();
	~PhongMaterial();

	Vector3 pos_light;
	Vector3 ia, id, is;
	Vector3 ka, kd, ks;
	float alpha;

	void setUniforms(Camera* camera, Matrix44 model);
	void renderInMenu();
};

class MirrorMaterial : public StandardMaterial {
public:


	MirrorMaterial();
	~MirrorMaterial();

	bool tone;
	bool gamma;

	void setUniforms(Camera* camera, Matrix44 model);
	void renderInMenu();
};

class PBRMaterial : public StandardMaterial {
public:


	PBRMaterial();
	~PBRMaterial();

	Vector3 pos_light;

	HDRE* environment;

	Texture* HDRE_faces[6];

	Texture* albedo_map;

	float rough_factor;
	Texture* rough_map;

	float metal_factor;
	Texture* metal_map;

	Texture* normal_map;
	Texture* brdf;

	//Texture* opacity_map;

	bool tone;
	bool gamma;

	void setTextures(int model);
	void setUniforms(Camera* camera, Matrix44 model);
	void renderInMenu();
};
#endif