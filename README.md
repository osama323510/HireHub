🚀 HireHub - Backend Infrastructure
HireHub is a comprehensive platform designed to bridge the gap between freelancers and project owners. Built with Laravel 11, the project emphasizes Clean Architecture principles and robust Design Patterns to ensure a high-quality, professional-grade backend.

🏗️ System Architecture
The project leverages modern architectural patterns to ensure scalability and ease of maintenance:

1. Service Pattern
Business logic is decoupled from Controllers and distributed into specialized Service classes to adhere to the Single Responsibility Principle (SRP):


User Services: Includes AuthService for session and authentication management.


Offer Services: Handles the complete offer lifecycle via CreateOfferService, AcceptedOfferService, and RejectOfferService.

Post Services: Manages project listings through CreatePostService, ShowPostService, and PostService.


Freelancer Services: Facilitates profile updates and advanced freelancer search functionality.


2. Dependency Injection (DI)
The system utilizes Interfaces to decouple services, making it easy to swap implementations (e.g., notification providers) without modifying core logic:

Notification Interface: The NotificationServiceInterface is bound to the EmailNotificationService implementation via the AppServiceProvider.


3. Validation & Security
Advanced Form Requests are implemented for every operation, utilizing the prepareForValidation hook for data sanitization:


Boolean Normalization: Safely converts incoming filter strings into actual boolean values.


Data Sanitization: Automatically trims whitespace and strips harmful HTML tags from text inputs like titles and names.


Security Rules: Implements custom validation rules, such as ForbiddenWords, to protect content integrity.


🛠️ Tech Stack
Framework: Laravel 11.


Authentication: Laravel Sanctum.


Database: MySQL, utilizing complex Eloquent Relationships (One-to-One, One-to-Many, and Polymorphic Relationships).


Date Management: Carbon for professional-grade timing and deadline formatting.

🚦 Core API Endpoints

route::post('/UpdateProfile',[FreelancerController::class,'update']);
json data is :
{ 
    "id": 1,
    "name": "Osama",
    "lastname": "Ali",
    "email": "osama.dev@example.com",
    "password": "secretPassword123",
    "phone": "963955123456",
    "hour_price": 20.5,
    "bio": "Experienced Laravel developer with a focus on clean architecture and service patterns.",
    "portfolio": "https://github.com/osama-hirehub",
    "image": "profiles/osama_avatar.png",
    "address": "Latakia, Syria",
    "skills": [
        {
            "id": 2,
            "years": 3
        },
        {
            "id": 5,
            "years": 1
        }
    ]
}

Route::post('/login', [AuthControler::class, 'login']);
json data is :

as freelancer
{
    "email": "choos from the database "
    "password": "password"
}

as clinet
{
    "email": "choos from the database "
    "password": "password"
}


route::get('/post/{id}',[PostController::class, 'show']);



route::get('/posts', [PostController::class, 'index']);
{
    "newpost": true,
    "thisMonth": true,
    "budgetlimit": 1000
}

Route::middleware(['auth:sanctum','is_client'])->group(function () {
    route::post('/CreatPost',[PostController::class,'create']);
});
{
    "title": "Build a Laravel API for HireHub Mobile App",
    "description": "We are looking for a backend engineer to develop a secure and scalable RESTful API. The project requires expertise in Laravel 11, Service Patterns, and Sanctum authentication. Please ensure clean code practices.",
    "budget": "fixed",
    "price": 500.00,
    "deadline": "2026-05-15",
    "tags": [1, 3, 7]
}


route::get('/freelancers', [FreelancerController::class, 'info']); 
{
    "sort_by_rating": true,
    "available": true,
    "verified": true
}


route::get('/freelancer/{id}', [FreelancerController::class, 'infoWithId']); 


Route::middleware(['auth:sanctum','is_freelancer'])->group(function () {
    
    route::post('/CreateOffer',[OfferControler::class,'create']);
});
{
    "post_id": 5,
    "offer_price": 250.75,
    "description": "I have extensive experience in Laravel and I can deliver this project with high quality and clean code.",
    "days": 4
}


route::get('/offer/{id}',[OfferControler::class,'show']);

route::get('/accept/{id}',[OfferControler::class,'accept']);
route::get('/Reject/{id}',[OfferControler::class,'Reject']);



route::get('/Panel',[OwnerControler::class, 'Panel']);



Middleware in Laravel
There are two kinds of middleware:

Global Middleware:
These run on every HTTP request handled by the application. In your case, you use them to log every API route and request into the database for monitoring or auditing.

Local (Route) Middleware:
These are assigned to specific routes or groups. You use them to authorize the authenticated user by detecting their role (e.g., checking if the user is a Freelancer or a Client) before allowing access to certain endpoints.


⚙️ Installation
1 Install Dependencies:

        composer install

2 Environment Setup:

        Configure your .env file with database credentials.

        Generate application key: php artisan key:generate.

3 Database Initialization:

        php artisan migrate --seed
        

4 Optimize Autoloading:

        composer dump-autoload

💡 Developer Notes
Data models are engineered with advanced Attribute Casting and Accessors. This includes automatic status calculation for project deadlines (e.g., "Expired" or "Active for X days") and standardized currency formatting for price fields directly at the model level.