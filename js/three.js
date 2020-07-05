
let tex;
function preload() {
  tex = templateUrl + '/js/assets/texture.jpg';
  // font = loadFont(templateUrl + '/js/assets/Syne-Bold.otf');
}
window.addEventListener('load', function () {
  preload();
})


let greetings = document.getElementsByClassName("greeting")[0];
var stats, scene, renderer, composer, model;
var start = Date.now();
let previousDate = start;
var camera, cameraControls;
var Variables = function () {
  this.speed = 0.0;
  this.repeatPattern = 30.0;
  this.scroll = 0;//0.5
  this.noiseHeight = 1.1;//0.5
  this.noiseSize = 0.004;//0.09

}
var variables = new Variables();
var gui = new dat.GUI();
gui.add(variables, 'speed', 0, 2);
gui.add(variables, 'repeatPattern', 0, 180);
gui.add(variables, 'scroll', 0, 1.0);
gui.add(variables, 'noiseHeight', 0, 5.0);
gui.add(variables, 'noiseSize', 0, 0.5);

if (!init()) {
  // if (Date.now() % 8 === 0) {
  animate();
  // };
}
function init() {
  // renderer = new THREE.WebGLRenderer({
  //   antialias: true,	// to get smoother output
  // });

  let pixelRatio = window.devicePixelRatio
  let AA = true
  if (pixelRatio > 1) {
    AA = false
  }

  renderer = new THREE.WebGLRenderer({
    antialias: AA,
    powerPreference: "high-performance",
  })



  renderer.setClearColor(0x121212);//bbbbbb
  renderer.setSize(window.innerWidth, greetings.clientHeight + 80);
  renderer.setPixelRatio(window.devicePixelRatio); /// 4
  renderer.context.disable(renderer.context.DEPTH_TEST);

  // var composer = new EffectComposer(renderer);
  composer = new THREE.EffectComposer(renderer);
  document.getElementById('container').appendChild(renderer.domElement);
  stats = new Stats();
  stats.domElement.style.position = 'absolute';
  stats.domElement.style.bottom = '0px';
  document.body.appendChild(stats.domElement);
  scene = new THREE.Scene();
  scene.fog = new THREE.Fog(0xbbbbbb, 35, 100);

  camera = new THREE.PerspectiveCamera(35, window.innerWidth / window.innerHeight, 100, 800);
  camera.position.set(0, 0, 250);
  scene.add(camera);
  cameraControls = new THREE.TrackballControls(camera, renderer.domElement)

  var renderPass = new THREE.RenderPass(scene, camera);
  composer.addPass(renderPass);
  let effectFilm = new THREE.FilmPass(4.0, 0.0005, 0.007, false);//0.8, 0.325, 256, false   0.2, 0.005, 0.001, false
  effectFilm.renderToScreen = true;

  composer.addPass(effectFilm);
  //   var luminosityPass = new THREE.ShaderPass( THREE.FilmPass(0.8, 0.325, 256, false) );
  // composer.addPass( luminosityPass );

  // var glitchPass = new THREE.GlitchPass();
  // composer.addPass(glitchPass);




  var geometry = new THREE.PlaneBufferGeometry
    (window.innerWidth, greetings.clientHeight + 200, 100, 80);; //(16, 16, 50, 50);
  var material = new THREE.ShaderMaterial({
    uniforms: {

      texture: {
        type: "t",
        value: THREE.ImageUtils.loadTexture(templateUrl + '/js/assets/colors.png')//rainbow-aqua
      },
      time: { // float initialized to 0
        type: "f",
        value: 0.0
      },
      scrollPercentage: {
        type: "f",
        value: variables.scroll,
      },

      repeatPattern: {
        type: "f",
        value: variables.repeatPattern,
      },
      noiseHeight: {
        type: "f",
        value: variables.noiseHeight,
      },
      noiseSize: {
        type: "f",
        value: variables.noiseSize, //0.09 for normal wobble
      },
      mouse: {
        type: "vec2",
        value: [0,0], //0.09 for normal wobble
      },
      FARPLANE: { type: "f", value: 300.0 },
      DEPTH: { type: "f", value: 5.0 },
    },

    vertexShader: document.getElementById('vertexShader').textContent,
    fragmentShader: document.getElementById('fragmentShader').textContent
  });

  material.side = THREE.DoubleSide;
  model = new THREE.Mesh(geometry, material);
  model.position.z -= 450;
  scene.add(model);


  // console.log(model.material.uniforms['texture'].value)



}
function animate() {

  // console.log(Date.now() - start)
  
  setTimeout(function () {
    requestAnimationFrame(animate);
  }, 1000 / 30);

  render();

}
function render() {
  if(window.pageYOffset <= greetings.clientHeight){
  cameraControls.update();
  stats.update();

  let max = greetings.clientHeight;
  let current = (Math.round(window.pageYOffset) /  max).toFixed(2);
  // console.log(current)


  model.material.uniforms['time'].value = .000055 * (Date.now() - start);//.00025
  // model.material.uniforms['repeatPattern'].value = variables.repeatPattern;
  model.material.uniforms['noiseHeight'].value = variables.noiseHeight;
  model.material.uniforms['scrollPercentage'].value = current;
  model.material.uniforms['noiseSize'].value = variables.noiseSize;

  // renderer.render(scene, camera);
  composer.render();
}
}
window.addEventListener( 'resize', onWindowResize, false );
greetings.addEventListener( 'mousemove', mouseMove, false );
function mouseMove(e) {
  model.material.uniforms['mouse'].value.x = e.pageX / window.innerWidth;
  model.material.uniforms['mouse'].value.y = e.pageY / window.innerWidth;
  // console.log(model.material.uniforms['mouse'].value);
  // model.material.uniforms['noiseHeight'].value.x = e.pageY / window.innerHeight;
}
function onWindowResize(){

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize( window.innerWidth, greetings.clientHeight + 80 );

}