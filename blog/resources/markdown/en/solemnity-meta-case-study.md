---
title: "Building the Solemnity Meta Project"
featured: false
excerpt: "Solemnity Meta is part of the solemnity suite, a microservice that extracts metadata from URLs and returns it in JSON format, ideal for applications like Twitter cards. Developed using Go and Docker, it ensures efficient, accurate metadata extraction. The project demonstrates the power of microservices and the efficiency of Go for web data handling."
hero_image: "https://file.swayechateau.com/view/globalMaJKf2UDzFdqba7hG96U6?share_code=s6LHjQlIsFHc"
category: "Case Study"
author: "NobodyCares"
---

## Case Study: Building Solemnity Meta (Microservice)

### Introduction

In today's digital era, extracting and utilizing metadata from web links is essential for applications like social media sharing and SEO. This case study explores the development of Solemnity Meta, a microservice designed to retrieve metadata from web links and return it in JSON format for use in other services, such as Twitter cards. Initially written in PHP using Lumen version 9, it has been ported to Go for a more portable and secure API.

### Objectives

- **Create a Simple Microservice:** Develop a microservice to efficiently extract metadata from URLs.

- **Utilize Go for Development:** Leverage the Go programming language for its efficiency and performance.

- **Provide JSON Output:** Ensure the metadata is returned in JSON format for easy integration with other services.

### Technology Stack

- **Go:** A statically typed, compiled programming language designed for simplicity and performance.

- **Docker:** Used for containerizing the application to ensure portability and ease of deployment.

### Development Process

#### 1. Setting Up the Project

The project began with setting up a Go environment and initializing a new repository. Docker was used to create a containerized environment, making it easier to manage dependencies and deployments.

#### 2. Building the Metadata Extraction Logic

The core functionality of Solemnity Meta involves making HTTP requests to URLs and parsing the HTML to extract metadata. This includes information such as the site name, title, description, keywords, and images.

#### 3. Implementing the API Endpoints

Two API endpoints were created:

- **GET Request:** Allows users to retrieve metadata by passing a URL as a query parameter.

- **POST Request:** Accepts a URL in the request body and returns the metadata.

#### 4. Testing and Optimization

Extensive testing was conducted to ensure the microservice could handle various types of URLs and return accurate metadata. Performance optimizations were implemented to ensure quick response times.

### Challenges and Solutions

#### Handling Different Metadata Formats

**Challenge:** Websites use different metadata formats, such as Open Graph and Twitter cards.

**Solution:** Implemented a flexible parser that can handle multiple metadata formats and extract relevant information.

#### Ensuring Data Accuracy

**Challenge:** Ensuring the extracted metadata is accurate and up-to-date.

**Solution:** Implemented robust error handling and validation to verify the accuracy of the extracted data.

#### Denied HTML Content Access

**Challenge:** Some websites, like X, block web scraping requests.

**Solution:** Changing the user agent to Googlebot resolved this issue.

### Results and Impact

Solemnity Meta successfully provides a simple and efficient way to extract metadata from URLs and return it in JSON format. This microservice is useful for developers looking to integrate metadata extraction into their applications, enhancing the sharing capabilities and SEO performance of web content.

### How It Works

There are two ways to get a website's metadata with Solemnity Meta: using either a POST or GET request. The following fields are supported:

| Field  | Type    | Required | Default |
|--------|---------|----------|---------|
| link   | String  | Yes      | null    |
| all    | Boolean | No       | false   |
| secure | Boolean | No       | true    |

For instance, a GET request:

```sh
curl https://meta.solemnity.icu/api?link=https://www.youtube.com/watch?v=NeaXsRg5ho0&all=true
```

And a POST Request

```sh
curl -X POST -d 'link=www.youtube.com/watch?v=NeaXsRg5ho0' -d 'all=yes' https://meta.solemnity.icu
```

### Api Response Examples

`Full`

``` json
{
	"link": "https://www.youtube.com/watch?v=NeaXsRg5ho0",
	"linkValid": true,
	"all": true,
	"meta": {
		"site_name": "YouTube",
		"url": "https://www.youtube.com/watch?v=NeaXsRg5ho0",
		"title": "Craftopia",
		"keywords": [
			"video",
			"sharing",
			"camera phone",
			"video phone",
			"free",
			"upload"
		],
		"image": {
			"uri": "https://i.ytimg.com/vi/NeaXsRg5ho0/maxresdefault.jpg?sqp=-oaymwEmCIAKENAF8quKqQMa8AEB-AH-DoACuAiKAgwIABABGBEgZShyMA8=&amp;rs=AOn4CLCsKFSmNpm4LaKh0PB_lu6pOtbdVg",
			"width": "1280",
			"height": "720"
		},
		"video": {
			"uri": "https://www.youtube.com/embed/NeaXsRg5ho0",
			"type": "text/html",
			"width": "1280",
			"height": "720"
		},
		"all": [
			{
				"name": "theme-color",
				"content": "rgba(255, 255, 255, 0.98)"
			},
			{
				"name": "title",
				"content": "Craftopia"
			},
			{
				"name": "keywords",
				"content": "video, sharing, camera phone, video phone, free, upload"
			},
			{
				"name": "robots",
				"content": "noindex"
			},
			{
				"name": "og:site_name",
				"content": "YouTube"
			},
			{
				"name": "og:url",
				"content": "https://www.youtube.com/watch?v=NeaXsRg5ho0"
			},
			{
				"name": "og:title",
				"content": "Craftopia"
			},
			{
				"name": "og:image",
				"content": "https://i.ytimg.com/vi/NeaXsRg5ho0/maxresdefault.jpg?sqp=-oaymwEmCIAKENAF8quKqQMa8AEB-AH-DoACuAiKAgwIABABGBEgZShyMA8=&amp;rs=AOn4CLCsKFSmNpm4LaKh0PB_lu6pOtbdVg"
			},
			{
				"name": "og:image:width",
				"content": "1280"
			},
			{
				"name": "og:image:height",
				"content": "720"
			},
			{
				"name": "al:ios:app_store_id",
				"content": "544007664"
			},
			{
				"name": "al:ios:app_name",
				"content": "YouTube"
			},
			{
				"name": "al:ios:url",
				"content": "vnd.youtube://www.youtube.com/watch?v=NeaXsRg5ho0&amp;feature=applinks"
			},
			{
				"name": "al:android:url",
				"content": "vnd.youtube://www.youtube.com/watch?v=NeaXsRg5ho0&amp;feature=applinks"
			},
			{
				"name": "al:web:url",
				"content": "http://www.youtube.com/watch?v=NeaXsRg5ho0&amp;feature=applinks"
			},
			{
				"name": "og:type",
				"content": "video.other"
			},
			{
				"name": "og:video:url",
				"content": "https://www.youtube.com/embed/NeaXsRg5ho0"
			},
			{
				"name": "og:video:secure_url",
				"content": "https://www.youtube.com/embed/NeaXsRg5ho0"
			},
			{
				"name": "og:video:type",
				"content": "text/html"
			},
			{
				"name": "og:video:width",
				"content": "1280"
			},
			{
				"name": "og:video:height",
				"content": "720"
			},
			{
				"name": "al:android:app_name",
				"content": "YouTube"
			},
			{
				"name": "al:android:package",
				"content": "com.google.android.youtube"
			},
			{
				"name": "fb:app_id",
				"content": "87741124305"
			},
			{
				"name": "twitter:card",
				"content": "player"
			},
			{
				"name": "twitter:site",
				"content": "@youtube"
			},
			{
				"name": "twitter:url",
				"content": "https://www.youtube.com/watch?v=NeaXsRg5ho0"
			},
			{
				"name": "twitter:title",
				"content": "Craftopia"
			},
			{
				"name": "twitter:image",
				"content": "https://i.ytimg.com/vi/NeaXsRg5ho0/maxresdefault.jpg?sqp=-oaymwEmCIAKENAF8quKqQMa8AEB-AH-DoACuAiKAgwIABABGBEgZShyMA8=&amp;rs=AOn4CLCsKFSmNpm4LaKh0PB_lu6pOtbdVg"
			},
			{
				"name": "twitter:app:name:iphone",
				"content": "YouTube"
			},
			{
				"name": "twitter:app:id:iphone",
				"content": "544007664"
			},
			{
				"name": "twitter:app:name:ipad",
				"content": "YouTube"
			},
			{
				"name": "twitter:app:id:ipad",
				"content": "544007664"
			},
			{
				"name": "twitter:app:url:iphone",
				"content": "vnd.youtube://www.youtube.com/watch?v=NeaXsRg5ho0&amp;feature=applinks"
			},
			{
				"name": "twitter:app:url:ipad",
				"content": "vnd.youtube://www.youtube.com/watch?v=NeaXsRg5ho0&amp;feature=applinks"
			},
			{
				"name": "twitter:app:name:googleplay",
				"content": "YouTube"
			},
			{
				"name": "twitter:app:id:googleplay",
				"content": "com.google.android.youtube"
			},
			{
				"name": "twitter:app:url:googleplay",
				"content": "https://www.youtube.com/watch?v=NeaXsRg5ho0"
			},
			{
				"name": "twitter:player",
				"content": "https://www.youtube.com/embed/NeaXsRg5ho0"
			},
			{
				"name": "twitter:player:width",
				"content": "1280"
			},
			{
				"name": "twitter:player:height",
				"content": "720"
			},
			{
				"name": "name",
				"content": "Craftopia"
			},
			{
				"name": "requiresSubscription",
				"content": "False"
			},
			{
				"name": "identifier",
				"content": "NeaXsRg5ho0"
			},
			{
				"name": "duration",
				"content": "PT0M38S"
			},
			{
				"name": "width",
				"content": "1280"
			},
			{
				"name": "height",
				"content": "720"
			},
			{
				"name": "playerType",
				"content": "HTML5 Flash"
			},
			{
				"name": "width",
				"content": "1280"
			},
			{
				"name": "height",
				"content": "720"
			},
			{
				"name": "isFamilyFriendly",
				"content": "true"
			},
			{
				"name": "regionsAllowed",
				"content": "AD,AE,AF,AG,AI,AL,AM,AO,AQ,AR,AS,AT,AU,AW,AX,AZ,BA,BB,BD,BE,BF,BG,BH,BI,BJ,BL,BM,BN,BO,BQ,BR,BS,BT,BV,BW,BY,BZ,CA,CC,CD,CF,CG,CH,CI,CK,CL,CM,CN,CO,CR,CU,CV,CW,CX,CY,CZ,DE,DJ,DK,DM,DO,DZ,EC,EE,EG,EH,ER,ES,ET,FI,FJ,FK,FM,FO,FR,GA,GB,GD,GE,GF,GG,GH,GI,GL,GM,GN,GP,GQ,GR,GS,GT,GU,GW,GY,HK,HM,HN,HR,HT,HU,ID,IE,IL,IM,IN,IO,IQ,IR,IS,IT,JE,JM,JO,JP,KE,KG,KH,KI,KM,KN,KP,KR,KW,KY,KZ,LA,LB,LC,LI,LK,LR,LS,LT,LU,LV,LY,MA,MC,MD,ME,MF,MG,MH,MK,ML,MM,MN,MO,MP,MQ,MR,MS,MT,MU,MV,MW,MX,MY,MZ,NA,NC,NE,NF,NG,NI,NL,NO,NP,NR,NU,NZ,OM,PA,PE,PF,PG,PH,PK,PL,PM,PN,PR,PS,PT,PW,PY,QA,RE,RO,RS,RU,RW,SA,SB,SC,SD,SE,SG,SH,SI,SJ,SK,SL,SM,SN,SO,SR,SS,ST,SV,SX,SY,SZ,TC,TD,TF,TG,TH,TJ,TK,TL,TM,TN,TO,TR,TT,TV,TW,TZ,UA,UG,UM,US,UY,UZ,VA,VC,VE,VG,VI,VN,VU,WF,WS,YE,YT,ZA,ZM,ZW"
			},
			{
				"name": "interactionCount",
				"content": "5"
			},
			{
				"name": "datePublished",
				"content": "2021-12-25"
			},
			{
				"name": "uploadDate",
				"content": "2021-12-25"
			},
			{
				"name": "genre",
				"content": "Gaming"
			}
		]
	}
}
```

`Short`

``` json
{
	"link": "https://www.youtube.com/watch?v=NeaXsRg5ho0",
	"linkValid": true,
	"all": false,
	"meta": {
		"site_name": "YouTube",
		"url": "https://www.youtube.com/watch?v=NeaXsRg5ho0",
		"title": "Craftopia",
		"keywords": [
			"video",
			"sharing",
			"camera phone",
			"video phone",
			"free",
			"upload"
		],
		"image": {
			"uri": "https://i.ytimg.com/vi/NeaXsRg5ho0/maxresdefault.jpg?sqp=-oaymwEmCIAKENAF8quKqQMa8AEB-AH-DoACuAiKAgwIABABGBEgZShyMA8=&amp;rs=AOn4CLCsKFSmNpm4LaKh0PB_lu6pOtbdVg",
			"width": "1280",
			"height": "720"
		},
		"video": {
			"uri": "https://www.youtube.com/embed/NeaXsRg5ho0",
			"type": "text/html",
			"width": "1280",
			"height": "720"
		}
	}
}
```

### Conclusion

The development of Solemnity Meta demonstrates the power of microservices and the efficiency of the Go programming language. By creating a tool that simplifies metadata extraction, this project highlights the importance of making web data more accessible and usable for various applications.

---

You can find more about the Solemnity Meta project on its [GitHub repository](https://github.com/swayechateau/solemnity-meta).