<footer class="footer no-grid starter container-fluid">
	<!-- <h3>Let’s create something amazing together! 🌝✌️</h3> -->
	<ul class="">
		<li><a href="mailto:mariedvorzak@gmail.com"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/cross.svg">E-Mail</a></li>
		<li><a href="https://www.behance.net/dvorzakmar5f83"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/cross.svg">Behance</a></li>
		<li><a href="https://vimeo.com/user88204961"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/cross.svg">Vimeo</a></li>
	</ul>
	<span class="reference">© Coded by Marie Dvorzak</span>
	<div class="navigate">
		<!-- <span>drag to navigate</span> -->
	</div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.0.0/p5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/animation.gsap.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplex-noise/2.4.0/simplex-noise.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/107/three.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/paper.js/0.12.2/paper-full.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.7.7/dat.gui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/stats.js/r16/Stats.min.js"></script>
<script src="https://threejs.org/examples/js/controls/TrackballControls.js"></script>

<script src="<?php bloginfo('template_url'); ?>/js/threejs/CopyShader.js"></script>

<script src="<?php bloginfo('template_url'); ?>/js/threejs/EffectComposer.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/threejs/ShaderPass.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/threejs/RenderPass.js"></script>
<!-- <script src="<?php bloginfo('template_url'); ?>/js/threejs/LuminosityShader.js"></script> -->
<script src="<?php bloginfo('template_url'); ?>/js/threejs/FilmShader.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/threejs/FilmPass.js"></script>
<!-- <script src="<?php bloginfo('template_url'); ?>/js/threejs/GlitchPass.js"></script> --> -->

<script type="x-shader/x-vertex" id="vertexShader">


	vec3 mod289(vec3 x)
		{
			return x - floor(x * (1.0 / 289.0)) * 289.0;
		}
		
		vec4 mod289(vec4 x)
		{
			return x - floor(x * (1.0 / 289.0)) * 289.0;
		}
		
		vec4 permute(vec4 x)
		{
			return mod289(((x*34.0)+1.0)*x);
		}
		
		vec4 taylorInvSqrt(vec4 r)
		{
			return 1.79284291400159 - 0.85373472095314 * r;
		}
		
		vec3 fade(vec3 t) {
			return t*t*t*(t*(t*6.0-15.0)+10.0);
		}
		
		// Classic Perlin noise, periodic variant
		float pnoise(vec3 P, vec3 rep)
		{
			vec3 Pi0 = mod(floor(P), rep); // Integer part, modulo period
			vec3 Pi1 = mod(Pi0 + vec3(1.0), rep); // Integer part + 1, mod period
			Pi0 = mod289(Pi0);
			Pi1 = mod289(Pi1);
			vec3 Pf0 = fract(P); // Fractional part for interpolation
			vec3 Pf1 = Pf0 - vec3(1.0); // Fractional part - 1.0
			vec4 ix = vec4(Pi0.x, Pi1.x, Pi0.x, Pi1.x);
			vec4 iy = vec4(Pi0.yy, Pi1.yy);
			vec4 iz0 = Pi0.zzzz;
			vec4 iz1 = Pi1.zzzz;
		
			vec4 ixy = permute(permute(ix) + iy);
			vec4 ixy0 = permute(ixy + iz0);
			vec4 ixy1 = permute(ixy + iz1);
		
			vec4 gx0 = ixy0 * (1.0 / 7.0);
			vec4 gy0 = fract(floor(gx0) * (1.0 / 7.0)) - 0.5;
			gx0 = fract(gx0);
			vec4 gz0 = vec4(0.5) - abs(gx0) - abs(gy0);
			vec4 sz0 = step(gz0, vec4(0.0));
			gx0 -= sz0 * (step(0.0, gx0) - 0.5);
			gy0 -= sz0 * (step(0.0, gy0) - 0.5);
		
			vec4 gx1 = ixy1 * (1.0 / 7.0);
			vec4 gy1 = fract(floor(gx1) * (1.0 / 7.0)) - 0.5;
			gx1 = fract(gx1);
			vec4 gz1 = vec4(0.5) - abs(gx1) - abs(gy1);
			vec4 sz1 = step(gz1, vec4(0.0));
			gx1 -= sz1 * (step(0.0, gx1) - 0.5);
			gy1 -= sz1 * (step(0.0, gy1) - 0.5);
		
			vec3 g000 = vec3(gx0.x,gy0.x,gz0.x);
			vec3 g100 = vec3(gx0.y,gy0.y,gz0.y);
			vec3 g010 = vec3(gx0.z,gy0.z,gz0.z);
			vec3 g110 = vec3(gx0.w,gy0.w,gz0.w);
			vec3 g001 = vec3(gx1.x,gy1.x,gz1.x);
			vec3 g101 = vec3(gx1.y,gy1.y,gz1.y);
			vec3 g011 = vec3(gx1.z,gy1.z,gz1.z);
			vec3 g111 = vec3(gx1.w,gy1.w,gz1.w);
		
			vec4 norm0 = taylorInvSqrt(vec4(dot(g000, g000), dot(g010, g010), dot(g100, g100), dot(g110, g110)));
			g000 *= norm0.x;
			g010 *= norm0.y;
			g100 *= norm0.z;
			g110 *= norm0.w;
			vec4 norm1 = taylorInvSqrt(vec4(dot(g001, g001), dot(g011, g011), dot(g101, g101), dot(g111, g111)));
			g001 *= norm1.x;
			g011 *= norm1.y;
			g101 *= norm1.z;
			g111 *= norm1.w;
		
			float n000 = dot(g000, Pf0);
			float n100 = dot(g100, vec3(Pf1.x, Pf0.yz));
			float n010 = dot(g010, vec3(Pf0.x, Pf1.y, Pf0.z));
			float n110 = dot(g110, vec3(Pf1.xy, Pf0.z));
			float n001 = dot(g001, vec3(Pf0.xy, Pf1.z));
			float n101 = dot(g101, vec3(Pf1.x, Pf0.y, Pf1.z));
			float n011 = dot(g011, vec3(Pf0.x, Pf1.yz));
			float n111 = dot(g111, Pf1);
		
			vec3 fade_xyz = fade(Pf0);
			vec4 n_z = mix(vec4(n000, n100, n010, n110), vec4(n001, n101, n011, n111), fade_xyz.z);
			vec2 n_yz = mix(n_z.xy, n_z.zw, fade_xyz.y);
			float n_xyz = mix(n_yz.x, n_yz.y, fade_xyz.x); 
			return 2.2 * n_xyz;
		}

	
		
		// Modulo 7 without a division
		vec3 mod7(vec3 x) {
			return x - floor(x * (1.0 / 7.0)) * 7.0;
		}
		
		// Permutation polynomial: (34x^2 + x) mod 289
		vec3 permute(vec3 x) {
			return mod289((34.0 * x + 1.0) * x);
		}
		
		// Cellular noise, returning F1 and F2 in a vec2.
		// 3x3x3 search region for good F2 everywhere, but a lot
		// slower than the 2x2x2 version.
		// The code below is a bit scary even to its author,
		// but it has at least half decent performance on a
		// modern GPU. In any case, it beats any software
		// implementation of Worley noise hands down.
		
		vec2 cellular(vec3 P) {
		#define K 0.142857142857 // 1/7
		#define Ko 0.428571428571 // 1/2-K/2
		#define K2 0.020408163265306 // 1/(7*7)
		#define Kz 0.166666666667 // 1/6
		#define Kzo 0.416666666667 // 1/2-1/6*2
		#define jitter 2.0 // smaller jitter gives more regular pattern
		
			vec3 Pi = mod289(floor(P));
			 vec3 Pf = fract(P) - 0.5;
		
			vec3 Pfx = Pf.x + vec3(1.0, 0.0, -1.0);
			vec3 Pfy = Pf.y + vec3(1.0, 0.0, -1.0);
			vec3 Pfz = Pf.z + vec3(1.0, 0.0, -1.0);
		
			vec3 p = permute(Pi.x + vec3(-1.0, 0.0, 1.0));
			vec3 p1 = permute(p + Pi.y - 1.0);
			vec3 p2 = permute(p + Pi.y);
			vec3 p3 = permute(p + Pi.y + 1.0);
		
			vec3 p11 = permute(p1 + Pi.z - 1.0);
			vec3 p12 = permute(p1 + Pi.z);
			vec3 p13 = permute(p1 + Pi.z + 1.0);
		
			vec3 p21 = permute(p2 + Pi.z - 1.0);
			vec3 p22 = permute(p2 + Pi.z);
			vec3 p23 = permute(p2 + Pi.z + 1.0);
		
			vec3 p31 = permute(p3 + Pi.z - 1.0);
			vec3 p32 = permute(p3 + Pi.z);
			vec3 p33 = permute(p3 + Pi.z + 1.0);
		
			vec3 ox11 = fract(p11*K) - Ko;
			vec3 oy11 = mod7(floor(p11*K))*K - Ko;
			vec3 oz11 = floor(p11*K2)*Kz - Kzo; // p11 < 289 guaranteed
		
			vec3 ox12 = fract(p12*K) - Ko;
			vec3 oy12 = mod7(floor(p12*K))*K - Ko;
			vec3 oz12 = floor(p12*K2)*Kz - Kzo;
		
			vec3 ox13 = fract(p13*K) - Ko;
			vec3 oy13 = mod7(floor(p13*K))*K - Ko;
			vec3 oz13 = floor(p13*K2)*Kz - Kzo;
		
			vec3 ox21 = fract(p21*K) - Ko;
			vec3 oy21 = mod7(floor(p21*K))*K - Ko;
			vec3 oz21 = floor(p21*K2)*Kz - Kzo;
		
			vec3 ox22 = fract(p22*K) - Ko;
			vec3 oy22 = mod7(floor(p22*K))*K - Ko;
			vec3 oz22 = floor(p22*K2)*Kz - Kzo;
		
			vec3 ox23 = fract(p23*K) - Ko;
			vec3 oy23 = mod7(floor(p23*K))*K - Ko;
			vec3 oz23 = floor(p23*K2)*Kz - Kzo;
		
			vec3 ox31 = fract(p31*K) - Ko;
			vec3 oy31 = mod7(floor(p31*K))*K - Ko;
			vec3 oz31 = floor(p31*K2)*Kz - Kzo;
		
			vec3 ox32 = fract(p32*K) - Ko;
			vec3 oy32 = mod7(floor(p32*K))*K - Ko;
			vec3 oz32 = floor(p32*K2)*Kz - Kzo;
		
			vec3 ox33 = fract(p33*K) - Ko;
			vec3 oy33 = mod7(floor(p33*K))*K - Ko;
			vec3 oz33 = floor(p33*K2)*Kz - Kzo;
		
			vec3 dx11 = Pfx + jitter*ox11;
			vec3 dy11 = Pfy.x + jitter*oy11;
			vec3 dz11 = Pfz.x + jitter*oz11;
		
			vec3 dx12 = Pfx + jitter*ox12;
			vec3 dy12 = Pfy.x + jitter*oy12;
			vec3 dz12 = Pfz.y + jitter*oz12;
		
			vec3 dx13 = Pfx + jitter*ox13;
			vec3 dy13 = Pfy.x + jitter*oy13;
			vec3 dz13 = Pfz.z + jitter*oz13;
		
			vec3 dx21 = Pfx + jitter*ox21;
			vec3 dy21 = Pfy.y + jitter*oy21;
			vec3 dz21 = Pfz.x + jitter*oz21;
		
			vec3 dx22 = Pfx + jitter*ox22;
			vec3 dy22 = Pfy.y + jitter*oy22;
			vec3 dz22 = Pfz.y + jitter*oz22;
		
			vec3 dx23 = Pfx + jitter*ox23;
			vec3 dy23 = Pfy.y + jitter*oy23;
			vec3 dz23 = Pfz.z + jitter*oz23;
		
			vec3 dx31 = Pfx + jitter*ox31;
			vec3 dy31 = Pfy.z + jitter*oy31;
			vec3 dz31 = Pfz.x + jitter*oz31;
		
			vec3 dx32 = Pfx + jitter*ox32;
			vec3 dy32 = Pfy.z + jitter*oy32;
			vec3 dz32 = Pfz.y + jitter*oz32;
		
			vec3 dx33 = Pfx + jitter*ox33;
			vec3 dy33 = Pfy.z + jitter*oy33;
			vec3 dz33 = Pfz.z + jitter*oz33;
		
			vec3 d11 = dx11 * dx11 + dy11 * dy11 + dz11 * dz11;
			vec3 d12 = dx12 * dx12 + dy12 * dy12 + dz12 * dz12;
			vec3 d13 = dx13 * dx13 + dy13 * dy13 + dz13 * dz13;
			vec3 d21 = dx21 * dx21 + dy21 * dy21 + dz21 * dz21;
			vec3 d22 = dx22 * dx22 + dy22 * dy22 + dz22 * dz22;
			vec3 d23 = dx23 * dx23 + dy23 * dy23 + dz23 * dz23;
			vec3 d31 = dx31 * dx31 + dy31 * dy31 + dz31 * dz31;
			vec3 d32 = dx32 * dx32 + dy32 * dy32 + dz32 * dz32;
			vec3 d33 = dx33 * dx33 + dy33 * dy33 + dz33 * dz33;
		
			// Sort out the two smallest distances (F1, F2)
		#if 0
			// Cheat and sort out only F1
			vec3 d1 = min(min(d11,d12), d13);
			vec3 d2 = min(min(d21,d22), d23);
			vec3 d3 = min(min(d31,d32), d33);
			vec3 d = min(min(d1,d2), d3);
			d.x = min(min(d.x,d.y),d.z);
			return vec2(sqrt(d.x)); // F1 duplicated, no F2 computed
		#else
			// Do it right and sort out both F1 and F2
			vec3 d1a = min(d11, d12);
			d12 = max(d11, d12);
			d11 = min(d1a, d13); // Smallest now not in d12 or d13
			d13 = max(d1a, d13);
			d12 = min(d12, d13); // 2nd smallest now not in d13
			vec3 d2a = min(d21, d22);
			d22 = max(d21, d22);
			d21 = min(d2a, d23); // Smallest now not in d22 or d23
			d23 = max(d2a, d23);
			d22 = min(d22, d23); // 2nd smallest now not in d23
			vec3 d3a = min(d31, d32);
			d32 = max(d31, d32);
			d31 = min(d3a, d33); // Smallest now not in d32 or d33
			d33 = max(d3a, d33);
			d32 = min(d32, d33); // 2nd smallest now not in d33
			vec3 da = min(d11, d21);
			d21 = max(d11, d21);
			d11 = min(da, d31); // Smallest now in d11
			d31 = max(da, d31); // 2nd smallest now not in d31
			d11.xy = (d11.x < d11.y) ? d11.xy : d11.yx;
			d11.xz = (d11.x < d11.z) ? d11.xz : d11.zx; // d11.x now smallest
			d12 = min(d12, d21); // 2nd smallest now not in d21
			d12 = min(d12, d22); // nor in d22
			d12 = min(d12, d31); // nor in d31
			d12 = min(d12, d32); // nor in d32
			d11.yz = min(d11.yz,d12.xy); // nor in d12.yz
			d11.y = min(d11.y,d12.z); // Only two more to go
			d11.y = min(d11.y,d11.z); // Done! (Phew!)
			return sqrt(d11.xy); // F1, F2
		#endif
		}



		varying vec2 vUv;
		varying float noise;
		varying float displacement;
		uniform float time;
		uniform float noiseSize;
		uniform float  noiseHeight;
		uniform float repeatPattern;
		varying float DEPTH ;
    uniform vec2 mouse;
		uniform float scrollPercentage;
		uniform float FARPLANE ;


		float turbulence( vec3 p ) {
		
			float w = 100.0;
			float t = -.5;
		
			for (float f = 1.0 ; f <= 10.0 ; f++ ){
				float power = pow( 30.0, f );
				t += abs( pnoise( vec3( power * p ), vec3( 10.0, 10.0, 10.0 ) ) / power );
			}
		
			return t;
		
		}
		float rand(vec2 co){
    return fract(sin(dot(co.xy ,vec2(12.9898,78.233))) * 43758.5453);
    }
		void main() {
		
		//vUv = uv;
		float value = vUv.x;
			// add time to the noise parameters so it's animated
		//	noise = 10.0 *  -.10 * turbulence( .5 * normal + time );
		//	float b = 5.0 * pnoise( noiseSize * position + vec3( 2.0 * time ), vec3( 100.0 ) );
		//	float displacement = - noise + b;
		
			//vec3 newPosition = position + normal + abs(sin(value * 1.9 * 190.0 * 0.5 + time)) + displacement;
		//	gl_Position = projectionMatrix * modelViewMatrix * vec4( newPosition, 1.0 );
    
    

		
		vUv = uv;

		// add time to the noise parameters so it's animated
		noise = 0.1*  -.4 * turbulence( .5 * normal + (time) );//0.5

	  float noiseSizePercent = noiseSize * 1.0 +  (scrollPercentage / 200.0);
		//float b = 2.0 * pnoise( noiseSizePercent * mod(position, repeatPattern) + vec3( time / 1.5 ), vec3( 900.0 ) ); // multiply sinusDisplacement  with noiseSize
		float b = 2.0 * pnoise( noiseSizePercent * (position * (1.0 + scrollPercentage) + mouse.x + mouse.y) + vec3( time / 1.5 ), vec3( 900.0 ) ); // multiply sinusDisplacement  with noiseSize

		//float bTwo = 7.0 * pnoise( 3.0 * position + vec3( 1.5 * time ), vec3( 100.0 ) );

		displacement = - clamp((noise) + (b * (- b * (noiseHeight))) ,- 1.0, 1.0); //* (bTwo * 2.0), -1.0, 1.0) ; //0.5 factor of height
		float sinusDisplacement = (cos(vUv.y * 3.1415 * clamp((80.3 * time), 1.0, 7.5) * (sin(time))));
		sinusDisplacement += (sin(vUv.x * 3.1415 * clamp((2.3 * time), 0.2, 0.3) * (7.0)))*7.0; //change 7 to 10 for sinus depth


		vec3 newPosition = (position + normal * ( (displacement * (displacement * 10.0) + (sinusDisplacement * 10.0) )));// * vec3(rand(vec2(10.0, 20.0)), rand(10.0, 29.9), 1.0);// * (displacement * (displacement * 10.0) );
		gl_Position = projectionMatrix * modelViewMatrix * vec4( (newPosition), 1.0 );// * (vec4(sinusDisplacement / 20.0, 1.0));
		DEPTH = ((gl_Position.z *1.0) / (FARPLANE + 200.0));//0.5 & 10.0
	
	}

		</script>

<script src="./fragmentshader.js" type="x-shader/x-vertex" id="fragmentShader">
	varying vec2 vUv;
		varying float noise;
		varying float displacement;
    uniform float time;
    uniform vec2 mouse;
		uniform sampler2D texture;
		uniform sampler2D texturedetails;
		uniform float scrollPercentage;
		varying float DEPTH;
		#define TWO_PI 6.28318530718
		
		
		
		
		float random(vec3 scale, float seed){
			return fract(sin(dot(gl_FragCoord.xyz + seed, scale)) * 43758.5453 + seed);
		}
		vec3 hsb2rgb( in vec3 c){
			vec3 rgb = clamp(abs(mod(c.x * 6.0 + vec3(0.0, 4.0, 2.0),
				6.0) - 3.0) - 1.0,
				0.0,
				1.0);
			rgb = rgb * rgb * (3.0 - 2.0 * rgb);
			return c.z * mix(vec3(1.0), rgb, c.y);
		}
    float rand(vec2 co){
    return fract(sin(dot(co.xy ,vec2(12.9898,78.233))) * 43758.5453);
    }
		float circle(in vec2 _st, in float _radius){
    vec2 dist = _st-vec2(0.5);

	return 0.5-smoothstep(_radius-(_radius*5.0),_radius+(_radius*0.01),dot(dist * mouse.x,dist+mouse.y)*4.0);
}

void circleMouse( out vec4 fragColor, in vec2 fragCoord )
{
    vec2 st = fragCoord.xy/vUv.xy;

    vec2 dist = mouse/vUv - st.xy;
    dist.x *= vUv.x/vUv.y;

    float mouse_pct = length(dist);

    mouse_pct = step(0.3, mouse_pct);
    vec3 m_color = vec3(mouse_pct);
    fragColor = vec4(m_color, 1.0);
}

		void main() {
			vec2 st = gl_FragCoord.xy / (((2000.2)));
			vec3 red = vec3(0.5, 0.09, 0.0);
			vec3 green = vec3(0.0, 1.0, 0.0);
			vec3 blue = vec3(0.0, 0.0, 1.0);
			vec3 black = vec3(0.0, 0.0, 0.0);
			vec2 toCenter = vec2(0.5) - st;
		
			float angle = atan(toCenter.y, toCenter.x);
			float radius = length(toCenter) * 2.0;
		
		
			float r = .01 * random(vec3(12.9898, 78.233, 151.7182), 0.0);
		
			//	float percent = abs(sin(vUv.x * 3.1415 * 120.0)); // Abstufungen
			float percent = smoothstep(1.0, 0.27, 12.0);//0.27, 0.27, 12.0
			vec3 color = vec3(0.5, 0.5, 0.5);
			vec3 violet = mix(red, blue, 0.5);
			//vec3 violet = mix(red, blue, 0.5);
		
			color /= vec3((20.0 * 1.0 * 900.0) / (900.0 + 1.0 - DEPTH * (900.0 - 1.0))) / vec3(850.0);
			vec3 gradient = hsb2rgb(vec3((angle / TWO_PI) - 1.5, radius, 0.3));//mix(blue, blue, 5.0)
			vec3 rainbowGradient = hsb2rgb(vec3((angle / TWO_PI / 2.0) + 1.5, radius, 1.0));
		
			vec2 tPos = vec2(0, 29.3 * displacement + r); //1.3
			//	vec4 text = texture2D( texture, vUv + (displacement / 10.0) * - displacement );
		
      vec4 text = vec4((rainbowGradient / noise) + (displacement / 10.0) * - displacement, 2.0);
			vec4 exp = vec4((0.3 * 300.0 * 100.0) / (100.0 + 0.8 - DEPTH * (135.0 - 0.8))) / vec4(900.0);
			// exp += texture2D(texture, vUv + .2 + (displacement * 0.4) * - displacement);
			vec4 texForMix = texture2D(texture, vUv + .2 + (displacement * 0.4) * - displacement);
			 exp += mix(texForMix, vec4(gradient, displacement), scrollPercentage);


			 exp += circle(st,0.01);
			 //exp -= circleMouse(exp, mouse);

			//exp += vec4(vUv.x,vUv.y, 1.0, 1.0 );

			text /= vec4((1.0 * 400.0 * 900.0) / (900.0 + 1.0 - DEPTH * (900.0 - 1.0))) / vec4(900.0);
			text += texture2D(texture, vUv + .2 + (displacement * 0.4) * - displacement );
			//text += texture2D(texture, vUv + (displacement) * - displacement );// + displacement);
     // gl_FragColor = text, 1.0;
      gl_FragColor = exp;
     
		}
	
</script>
<script type="text/javascript">
	const templateUrl = '<?= get_bloginfo("template_url"); ?>';
</script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/main.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/three.js"></script>