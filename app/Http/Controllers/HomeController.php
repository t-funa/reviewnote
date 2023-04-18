<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Unit;
use App\Models\Purpose;
use App\Models\Review;
use App\Models\Student;
use App\Models\Experience;
use App\Models\Experience_student;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('top');
    }

    /**
     * semester詳細を表示する
     * @param int $id
     * @return view
     */
    public function semester($id)
    {
        $semester = Semester::with('subjects','units','purposes','reviews')->find($id);
        Session::put('semester',$semester);
        return view('home',['semester'=>$semester]);
    }

    public function home(){
        $semester = Session::get('semester');
        return view('home',['semester'=>$semester]);
    }

    public function show(){
        $user_id = Session::get('user_id');
        $semester = Session::get('semester');
        $subjects = Subject::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $units = Unit::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $purposes = Purpose::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $reviews = Review::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        return view('show',['semester'=>$semester,'subjects'=>$subjects,'units'=>$units,'purposes'=>$purposes,'reviews'=>$reviews]);
    }

    /**
     * subject詳細を表示する
     * @param int $id
     * @return view
     */
    public function subject($id)
    {
        $user_id = Session::get('user_id');
        $semester = Session::get('semester');
        $subjects = Subject::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $subject = Subject::with('user','semester','units','purposes','reviews')->find($id);
        $units = Unit::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $purposes = Purpose::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $reviews = Review::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        return view('unitCreate',['semester'=>$semester,'subjects'=>$subjects,'subject'=>$subject,'units'=>$units,'purposes'=>$purposes,'reviews'=>$reviews]);
    }

    /**
     * subject詳細を表示する
     * @param int $id
     * @return view
     */
    public function resultSubject($id)
    {
        $user_id = Session::get('user_id');
        $semester = Session::get('semester');
        $subjects = Subject::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $subject = Subject::with('user','semester','units','purposes','reviews')->find($id);
        $students = Student::where('subject_id',$subject['id'])->where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $units = Unit::where('subject_id',$subject['id'])->where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $purposes = Purpose::where('subject_id',$subject['id'])->where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $reviews = Review::where('subject_id',$subject['id'])->where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
            foreach($reviews as $review){
                $n_reviews = Review::where('student_id',$review['student_id'])->where('subject_id',$subject['id'])->where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
                $point_sum = $n_reviews->sum('point');
                $student = Student::where('id',$review['student_id'])->where('subject_id',$subject['id'])->where('semester_id',$semester['id'])->where('user_id',$user_id)->update(['point_sum' => $point_sum]);
            }
        $max = Student::where('subject_id',$subject['id'])->where('semester_id',$semester['id'])->where('user_id',$user_id)->max('point_sum');
        return view('result',['semester'=>$semester,'subjects'=>$subjects,'subject'=>$subject,'students'=>$students,'units'=>$units,'purposes'=>$purposes,'reviews'=>$reviews,'max'=>$max]);
    }

    public function experienceHome(){
        $semester = Session::get('semester');
        $experiences = Experience::where('semester_id',$semester['id'])->get();
        return view('experience',['experiences'=>$experiences,'semester'=>$semester]);
    }

    /**
     * subject詳細を表示する
     * @param int $id
     * @return view
     */
    public function experience($id)
    {
        $user_id = Session::get('user_id');
        $semester = Session::get('semester');
        $experience = Experience::where('semester_id',$semester['id'])->find($id);
        $experience_students = Experience_student::where('experience_id',$id)->get();
        $students = Student::where('semester_id',$semester['id'])->get();
        foreach($students as $student){
            $students_numbers[] = $student['number'];
        }
        foreach($experience_students as $experience_student){
            $experience_student_numbers[] = $experience_student['number'];
        }
        $student_numbers = array_unique($students_numbers);
        if(isset($experience_student_numbers)){
            $inexperienced_numbers = array_diff($student_numbers,$experience_student_numbers);
            sort($inexperienced_numbers);
            foreach($inexperienced_numbers as $inexperienced_number){
                $inexperienced_students[] = Student::where('number',$inexperienced_number)->where('semester_id',$semester['id'])->first();
            }
        }else{
            sort($student_numbers);
            foreach($student_numbers as $student_number){
                $inexperienced_students[] = Student::where('number',$student_number)->where('semester_id',$semester['id'])->first();
            }
        }
        return view('experienceShow',['experience_students'=>$experience_students,'inexperienced_students'=>$inexperienced_students,'semester'=>$semester,'experience'=>$experience]);
    }

    /**
     * unit詳細を表示する
     * @param int $id
     * @return view
     */
    public function unit($id)
    {
        $user_id = Session::get('user_id');
        $semester = Session::get('semester');
        $subjects = Subject::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $units = Unit::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $unit = Unit::with('user','semester','subject','purposes','reviews')->find($id);
        $purposes = Purpose::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $reviews = Review::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        return view('purposeCreate',['semester'=>$semester,'subjects'=>$subjects,'units'=>$units,'unit'=>$unit,'purposes'=>$purposes,'reviews'=>$reviews]);
    }

    /**
     * purpose詳細を表示する
     * @param int $id
     * @return view
     */
    public function purpose($id)
    {
        $user_id = Session::get('user_id');
        $semester = Session::get('semester');
        $subjects = Subject::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $units = Unit::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $purposes = Purpose::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $purpose = Purpose::with('user','semester','subject','unit','reviews')->find($id);
        Session::put('purpose1',$purpose);
        $reviews = Review::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        return view('reviewCreate',['semester'=>$semester,'subjects'=>$subjects,'units'=>$units,'purposes'=>$purposes,'purpose'=>$purpose,'reviews'=>$reviews]);
    }

    public function reviewShow()
    {
        $user_id = Session::get('user_id');
        $semester = Session::get('semester');
        $subjects = Subject::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $units = Unit::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $purposes = Purpose::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $purpose = Session::get('purpose1');
        $reviews = Review::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        return view('reviewShow',['semester'=>$semester,'subjects'=>$subjects,'units'=>$units,'purposes'=>$purposes,'purpose'=>$purpose,'reviews'=>$reviews]);
    }

    public function studentTop(){
        return view('studentTop');
    }

    public function studentShow(){
        $user_id = Session::get('user_id');
        $semester = Session::get('semester');
        $purpose = Session::get('purpose');
        $number = Session::get('number');
        $purpose_id= $purpose['id'];
        $purpose_id--;
        while($purpose_id>0){
            $p = Purpose::where('id',$purpose_id)->first();
            if(isset($p)){
                if($purpose['subject_id']==$p['subject_id'] && $purpose['semester_id']==$p['semester_id']){
                    if($purpose['user_id']==$p['user_id']){
                        $purpose = $p;
                        $reviews = Review::where('purpose_id',$purpose['id'])->get();
                        foreach($reviews as $review){
                            $review_points[] = $review['point'];
                        }
                        $max_p = max($review_points);
                        $reviews = Review::where('purpose_id',$purpose['id'])->where('point',$max_p)->get();
                        $my_review = Review::where('purpose_id',$purpose['id'])->where('number',$number)->first();
                        return view('studentShow',['semester'=>$semester,'purpose'=>$purpose,'reviews'=>$reviews,'my_review'=>$my_review]);
                    }
                }
            }
            $purpose_id--;
        }
        $reviews = Review::where('purpose_id',$purpose['id'])->get();
        $my_review = Review::where('purpose_id',$purpose['id'])->where('number',$number)->first();
        return view('studentShow',['semester'=>$semester,'purpose'=>$purpose,'reviews'=>$reviews,'my_review'=>$my_review]);
    }

    public function studentReview(){
        $purpose = Session::get('purpose');
        if(isset($purpose)){
            return view('reviewSubmit',['purpose'=>$purpose]);
        }else{
            echo 'ふりかえり入力ページにデータが送られていません。';
        }
        
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $semester = Session::get('semester');
        $subjects = Subject::all();
        $units = Unit::all();
        $purposes = Purpose::all();
        $reviews = Review::all();

// 教科、体験、成績表の次の処理
        if($request->has('su')){
            Session::put('user_id',$request['user_id']);
            $semester = Session::get('semester');
            $subjects = Subject::where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->get();
            $units = Unit::where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->get();
            $purposes = Purpose::where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->get();
            $reviews = Review::where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->get();
            return view('show',['semester'=>$semester,'subjects'=>$subjects,'units'=>$units,'purposes'=>$purposes,'reviews'=>$reviews]);
        }elseif($request->has('re')){
            $semester = Session::get('semester');
            $subjects = Subject::where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->get();
            $units = Unit::where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->get();
            $purposes = Purpose::where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->get();
            $reviews = Review::where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->get();
            return view('resultTop',['semester'=>$semester,'subjects'=>$subjects,'units'=>$units,'purposes'=>$purposes,'reviews'=>$reviews]);
            }elseif($request->has('ex')){
                $semester = Session::get('semester');
                $experiences = Experience::where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->get();
            return view('experience',['experiences'=>$experiences,'semester'=>$semester]);
        }

// 年学期の新規登録
        if(isset($_POST['semesterAdd'])){
            $exist_semester = Semester::where('name',$data['semester'])->where('user_id',$data['user_id'])->first();
        if(empty($exist_semester['id'])){
            $semester_id = Semester::insertGetId(['name'=>$data['semester'],'user_id'=>$data['user_id']]);
        }else{
            $semester_id = $exist_semester->id;
            return redirect()->route('index')->with('success','同じ年学期がすでに存在しています。');
        }
            return redirect()->route('index',['subjects'=>$subjects,'units'=>$units,'purposes'=>$purposes,'reviews'=>$reviews])->with('success','年学期を追加しました。');
        }

// 体験の新規登録
        if(isset($_POST['experienceAdd'])){
            $exist_experience = Experience::where('name',$data['experience'])->where('semester_id',$data['semester_id'])->where('user_id',$data['user_id'])->first();
        if(empty($exist_experience['id'])){
            $experience_id = Experience::insertGetId(['name'=>$data['experience'],'semester_id'=>$data['semester_id'],'user_id'=>$data['user_id']]);
        }else{
            $experience_id = $exist_experience->id;
            return redirect()->route('experienceHome')->with('success','同じ体験がすでに存在しています。');
        }
            $experiences = Experience::where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->get();
            return redirect()->route('experienceHome',['semester'=>$semester,'experiences'=>$experiences])->with('success','体験を追加しました。');
        }

// 教科の新規登録
        if(isset($_POST['subjectAdd'])){
            $exist_subject = Subject::where('name',$data['subject'])->where('semester_id',$data['semester_id'])->where('user_id',$data['user_id'])->first();
        if(empty($exist_subject['id'])){
            $subject_id = Subject::insertGetId(['name'=>$data['subject'],'semester_id'=>$data['semester_id'],'user_id'=>$data['user_id']]);
        }else{
            $subject_id = $exist_subject->id;
            return redirect()->route('show',['semester'=>$semester])->with('success','同じ教科がすでに存在しています。');
        }
            return redirect()->route('show',['semester'=>$semester,'subjects'=>$subjects,'units'=>$units,'purposes'=>$purposes,'reviews'=>$reviews])->with('success','教科を追加しました。');
        }

// 単元の新規登録      
        if(isset($_POST['unitAdd'])){
            $subject = Subject::where('id',$data['subject_id'])->where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->get();
            $exist_unit = Unit::where('name',$data['unit'])->where('subject_id',$data['subject_id'])->where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->first();
        if(empty($exist_unit['id'])){
            $unit_id = Unit::insertGetId(['name'=>$data['unit'],'subject_id'=>$data['subject_id'],'semester_id'=>$semester['id'],'user_id'=>$data['user_id']]);
        }else{
            $unit_id = $exist_unit->id;
            return back()->with('success','同じ単元がすでに存在しています。');
        }
            return back()->with('success','単元を追加しました。');
        }

// 授業のめあての新規登録 
        if(isset($_POST['purposeAdd'])){
            $subject = Subject::where('id',$data['subject_id'])->where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->get();
            $unit = Unit::where('id',$data['unit_id'])->where('subject_id',$data['subject_id'])->where('semester_id',$semester['id'])->where('user_id',$data['user_id'])->get();
            $exist_purpose = Purpose::where('content',$data['content'])->where('subject_id',$data['subject_id'])->where('unit_id',$data['unit_id'])->where('user_id',$data['user_id'])->first();
        if(empty($exist_purpose['id'])){
            $purpose_id = Purpose::insertGetId(['content'=>$data['content'],'unit_id'=>$data['unit_id'],'subject_id'=>$data['subject_id'],'semester_id'=>$semester['id'],'user_id'=>$data['user_id']]);
        }else{
            $purpose_id = $exist_purpose->id;
            return back()->with('success','同じ授業のめあてがすでに存在しています。');
        }
            return back()->with('success','授業のめあてを追加しました。');
        }

// 児童用ページに授業のめあての送信
        if(!empty($_POST['reviewSubmit'])){
            $purpose = Purpose::with('semester','subject','unit','reviews')->where('content',$data['reviewSubmit'])->first();
            Session::put('purpose',$purpose);
            return back()->with('success','授業のめあてを送信しました。');
        }

// ふりかえりの新規登録
        if(isset($_POST['reviewAdd'])){
            Session::put('number',$data['number']);
            $exist_review = Review::where('number',$data['number'])
            ->where('first_name',$data['first_name'])
            ->where('last_name',$data['last_name'])
            ->where('content',$data['content'])
            ->where('purpose_id',$data['purpose_id'])
            ->where('unit_id',$data['unit_id'])
            ->where('subject_id',$data['subject_id'])
            ->where('semester_id',$data['semester_id'])
            ->where('user_id',$data['user_id'])
            ->first();
            $exist_student = Student::where('number',$data['number'])
            ->where('first_name',$data['first_name'])
            ->where('last_name',$data['last_name'])
            ->where('subject_id',$data['subject_id'])
            ->where('semester_id',$data['semester_id'])
            ->where('user_id',$data['user_id'])
            ->first();
            if(empty($exist_student['number'])){
                $student_number = Student::insertGetId(['number'=>$data['number'],'first_name'=>$data['first_name'],'last_name'=>$data['last_name'],'subject_id'=>$data['subject_id'],'semester_id'=>$data['semester_id'],'user_id'=>$data['user_id']]); 
            }
            $student_id = Student::where('number',$data['number'])->first(['id']);
        if(empty($exist_review['id'])){
            $review_id = Review::insertGetId(['number'=>$data['number'],'first_name'=>$data['first_name'],'last_name'=>$data['last_name'],'content'=>$data['content'],'student_id'=>$student_id['id'],'purpose_id'=>$data['purpose_id'],'unit_id'=>$data['unit_id'],'subject_id'=>$data['subject_id'],'semester_id'=>$data['semester_id'],'user_id'=>$data['user_id']]);
            $semester = Session::get('semester');
            $experiences = Experience::all();
            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            $number = $data['number'];
            $experience_students = Experience_student::where('number',$number)->where('first_name',$first_name)->where('last_name',$last_name)->get();
            $experienced = array();
            $inexperienced =array();
            foreach($experience_students as $experience_student){ 
                foreach($experiences as $experience){
                    if($experience['id']==$experience_student['experience_id']){
                        $experienced[] = Experience::where('id',$experience_student['experience_id'])->first();
                        $experienced_ids[] = $experience_student['experience_id'];
                    }
                }
            }
            foreach($experiences as $experience){
                $experience_ids[] = $experience['id'];
            }
            if(isset($experienced_ids)){
                $inexperienced_ids = array_diff($experience_ids,$experienced_ids);
                foreach($inexperienced_ids as $inexperienced_id){
                    $inexperienced[] = Experience::where('id',$inexperienced_id)->first();
                }
            }else{
                $inexperienced = $experiences;
            }
        }else{
            $review_id = $exist_review->id;
            $semester = Session::get('semester');
            $experiences = Experience::all();
            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            $number = $data['number'];
            $experience_students = Experience_student::where('number',$number)->where('first_name',$first_name)->where('last_name',$last_name)->get();
            $experienced = array();
            $inexperienced =array();
            foreach($experience_students as $experience_student){ 
                foreach($experiences as $experience){
                    if($experience['id']==$experience_student['experience_id']){
                        $experienced[] = Experience::where('id',$experience_student['experience_id'])->first();
                        $experienced_ids[] = $experience_student['experience_id'];
                    }
                }
            }
            foreach($experiences as $experience){
                $experience_ids[] = $experience['id'];
            }
            if(isset($experienced_ids)){
                $inexperienced_ids = array_diff($experience_ids,$experienced_ids);
                foreach($inexperienced_ids as $inexperienced_id){
                    $inexperienced[] = Experience::where('id',$inexperienced_id)->first();
                }
            }else{
                $inexperienced = $experiences;
            }
            return view('experienceSubmit',['semester'=>$semester,'experiences'=>$experiences,'experienced'=>$experienced,'inexperienced'=>$inexperienced,'first_name'=>$first_name,'last_name'=>$last_name,'number'=>$number]);
        }
        
            return view('experienceSubmit',['semester'=>$semester,'experiences'=>$experiences,'experienced'=>$experienced,'inexperienced'=>$inexperienced,'first_name'=>$first_name,'last_name'=>$last_name,'number'=>$number]);
        }
        
// 体験済みへの変更
        if(isset($data['experience_name'])){
            $experience = Experience::where('name',$data['experience_name'])->where('semester_id',$data['semester_id'])->where('user_id',$data['user_id'])->first();
            $exist_experience_student = Experience_student::where('number',$data['number'])->where('first_name',$data['first_name'])->where('last_name',$data['last_name'])->where('experience_id',$experience['id'])->where('semester_id',$data['semester_id'])->where('user_id',$data['user_id'])->first();
            if(empty($exist_experience_student['id'])){
                $experience_student_id = Experience_student::insertGetId(['number'=>$data['number'],'first_name'=>$data['first_name'],'last_name'=>$data['last_name'],'experience_id'=>$experience['id'],'semester_id'=>$semester['id'],'user_id'=>$data['user_id']]);
            }else{
                $experience_student_id = $exist_experience_student->id;
            }
            
            $semester = Session::get('semester');
            $experiences = Experience::all();
            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            $number = $data['number'];
            $experience_students = Experience_student::where('number',$number)->where('first_name',$first_name)->where('last_name',$last_name)->get();
            $experienced = array();
            $inexperienced =array();
            foreach($experience_students as $experience_student){ 
                foreach($experiences as $experience){
                    if($experience['id']==$experience_student['experience_id']){
                        $experienced[] = Experience::where('id',$experience_student['experience_id'])->first();
                        $experienced_ids[] = $experience_student['experience_id'];
                    }
                }
            }
            foreach($experiences as $experience){
                $experience_ids[] = $experience['id'];
            }
            if(isset($experienced_ids)){
                $inexperienced_ids = array_diff($experience_ids,$experienced_ids);
                foreach($inexperienced_ids as $inexperienced_id){
                    $inexperienced[] = Experience::where('id',$inexperienced_id)->first();
                }
            }else{
                $inexperienced = $experiences;
            }
            
            return view('experienceSubmit',['semester'=>$semester,'experiences'=>$experiences,'experienced'=>$experienced,'inexperienced'=>$inexperienced,'first_name'=>$first_name,'last_name'=>$last_name,'number'=>$number]);
        }

// ふりかえり一覧に授業のめあての送信
        if(!empty($_POST['reviewShow'])){
            $semester = Session::get('semester');
            $purpose = Session::get('purpose1');
            $reviews = Review::where('purpose_id',$purpose['id'])->get();
            return view('reviewShow',['semester'=>$semester,'purpose'=>$purpose,'reviews'=>$reviews]);
        }

// キーワードをマーカー
        if(isset($_POST['search'])){
            $keywords = explode(",", $_POST['keywords']);
            $text_value = $_POST['keywords'];
            $purpose = Session::get('purpose1');
            $reviews = Review::where('purpose_id',$purpose['id'])->get();

            foreach($reviews as $review){
                foreach($keywords as $keyword){
                    $review['content'] = str::replaceFirst($keyword,"<span style='background-color:yellow'>$keyword</span>",$review['content']);
                }
            }
            
            return view('reviewShow',['semester'=>$semester,'purpose'=>$purpose,'reviews'=>$reviews,'review'=>$review,'text_value'=>$text_value]);
        }

// キーワードをカウント
        if(isset($_POST['evaluation'])){
            $keywords = explode(",", $_POST['keywords']);
            $purpose = Session::get('purpose1');
            $reviews = Review::where('purpose_id',$purpose['id'])->get();
            $r_s = Review::where('purpose_id',$purpose['id'])->get();
            foreach($reviews as $review){
                foreach($keywords as $keyword){
                    $review['content'] = str::replaceFirst($keyword,"<span style='background-color:yellow'>$keyword</span>",$review['content']);
                    $point = substr_count($review['content'],"<span style='background-color:yellow'>");
                    $review->point = $point;
                }
                foreach($r_s as $r){
                    if($review['id']==$r['id']){
                        $review['content']=$r['content'];
                    }
                }
                $review->update();
            }
        if(mb_substr($purpose['content'],-1)!='○'){
            $purpose['content'] = $purpose['content'].'○';
            $purpose->update();
        }
        return view('evaluation',['semester'=>$semester,'purpose'=>$purpose,'reviews'=>$reviews,'review'=>$review,'point'=>$point]);
        }

}

    public static function delete(Request $request){
        $data = $request->all();
        if(!empty($_POST['subjectIds'])){
            Subject::where('id',$data['subjectIds'])->delete();
            return redirect()->route('show')->with('success','教科の削除が完了しました。');
        }
        if(!empty($_POST['unitIds'])){
            Unit::where('id',$data['unitIds'])->delete();
            return redirect()->route('show')->with('success','単元の削除が完了しました。');
        }
        if(!empty($_POST['purposeIds'])){
            Purpose::where('id',$data['purposeIds'])->delete();
            return redirect()->route('show')->with('success','授業のめあて削除が完了しました。');
        }
        if(!empty($_POST['reviewIds'])){
            Review::where('id',$data['reviewIds'])->delete();
            return redirect()->route('show')->with('success','ふりかえりの削除が完了しました。');
        }
        if(!empty($_POST['experienceIds'])){
            Experience::where('id',$data['experienceIds'])->delete();
            return back()->with('success','体験の削除が完了しました。');
        }

        if(!empty($_POST['semesterIds'])){
            Semester::where('id',$data['semesterIds'])->delete();
            return back()->with('success','年学期の削除が完了しました。');
        }
    }

    public function deleteHome()
    {
        $user_id = Session::get('user_id');
        $semester = Session::get('semester');
        $subjects = Subject::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $units = Unit::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $purposes = Purpose::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        $reviews = Review::where('semester_id',$semester['id'])->where('user_id',$user_id)->get();
        return view('deleteHome',['semester'=>$semester,'subjects'=>$subjects,'units'=>$units,'purposes'=>$purposes,'reviews'=>$reviews]);
    }

    public function experienceDelete(){
        $semester = Session::get('semester');
        $experiences = Experience::where('semester_id',$semester['id'])->get();
        return view('experienceDelete',['semester'=>$semester,'experiences'=>$experiences]);
    }

    public function semesterDelete(){
        $user_id = Session::get('user_id');
        $semesters = Semester::where('user_id',$user_id)->get();
        return view('semesterDelete',['semesters'=>$semesters]);
    }

}
