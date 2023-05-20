<?php

namespace App\Providers;

use App\Http\IService\IAnswerService;
use App\Http\IService\IAttendanceService;
use App\Http\IService\IBloodService;
use App\Http\IService\IBookService;
use App\Http\IService\IClassroomService;
use App\Http\IService\IClassService;
use App\Http\IService\IFeesService;
use App\Http\IService\IGradeService;
use App\Http\IService\IGraduate;
use App\Http\IService\INationalityService;
use App\Http\IService\IParentService;
use App\Http\IService\IPromotion;
use App\Http\IService\IQuestionService;
use App\Http\IService\IQuizzService;
use App\Http\IService\IReligionService;
use App\Http\IService\ISpecializationService;
use App\Http\IService\IStudentFeesService;
use App\Http\IService\IStudentService;
use App\Http\IService\ISubjectService;
use App\Http\IService\ITeacherService;
use App\Http\Services\AnswerService;
use App\Http\Services\AttendanceService;
use App\Http\Services\BloodService;
use App\Http\Services\BookService;
use App\Http\Services\ClassroomService;
use App\Http\Services\ClassService;
use App\Http\Services\FeesService;
use App\Http\Services\GradeService;
use App\Http\Services\GraduateService;
use App\Http\Services\NationalityService;
use App\Http\Services\ParentService;
use App\Http\Services\PromotionService;
use App\Http\Services\QuestionService;
use App\Http\Services\QuizzService;
use App\Http\Services\ReligionService;
use App\Http\Services\SpecializationService;
use App\Http\Services\StudentFeesService;
use App\Http\Services\StudentService;
use App\Http\Services\SubjectService;
use App\Http\Services\TeacherService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ITeacherService::class,TeacherService::class);
        $this->app->bind(IGradeService::class,GradeService::class);
        $this->app->bind(ISpecializationService::class,SpecializationService::class);
        $this->app->bind(IStudentService::class,StudentService::class);
        $this->app->bind(IBloodService::class,BloodService::class);
        $this->app->bind(IReligionService::class,ReligionService::class);
        $this->app->bind(INationalityService::class,NationalityService::class);
        $this->app->bind(IParentService::class,ParentService::class);
        $this->app->bind(IClassService::class,ClassService::class);
        $this->app->bind(IClassroomService::class,ClassroomService::class);
        $this->app->bind(IPromotion::class,PromotionService::class);
        $this->app->bind(IGraduate::class,GraduateService::class);
        $this->app->bind(IFeesService::class,FeesService::class);
        $this->app->bind(IStudentFeesService::class,StudentFeesService::class);
        $this->app->bind(IAttendanceService::class,AttendanceService::class);
        $this->app->bind(ISubjectService::class,SubjectService::class);
        $this->app->bind(IQuizzService::class,QuizzService::class);
        $this->app->bind(IQuestionService::class,QuestionService::class);
        $this->app->bind(IBookService::class,BookService::class);
        $this->app->bind(IAnswerService::class,AnswerService::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
