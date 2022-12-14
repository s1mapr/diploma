package com.example.diploma.controllers;

import com.example.diploma.dto.CourseDTO;
import com.example.diploma.enteties.*;
import com.example.diploma.service.*;
import com.example.diploma.utils.YouTubeLinkParser;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Controller
@RequestMapping("/teacher")
public class TeacherController {

    private CourseService courseService;

    private UserCourseMapService userCourseMapService;

    private CourseMaterialService courseMaterialService;

    private TaskService taskService;

    private VariantService variantService;

    private UserMaterialMapService userMaterialMapService;

    @Autowired
    public void setUserMaterialMapService(UserMaterialMapService userMaterialMapService) {
        this.userMaterialMapService = userMaterialMapService;
    }

    @Autowired
    public void setVariantService(VariantService variantService) {
        this.variantService = variantService;
    }

    @Autowired
    public void setTaskService(TaskService taskService) {
        this.taskService = taskService;
    }

    @Autowired
    public void setCourseMaterialService(CourseMaterialService courseMaterialService) {
        this.courseMaterialService = courseMaterialService;
    }

    @Autowired
    public void setUserCourseMapService(UserCourseMapService userCourseMapService) {
        this.userCourseMapService = userCourseMapService;
    }

    @Autowired
    public void setCourseService(CourseService courseService) {
        this.courseService = courseService;
    }

    @GetMapping("/createCourse")
    public String createCourseGetMethod(Model model){
        model.addAttribute("course", new Course());
        return "teacher/createCourse";
    }

    @PostMapping("/createCourse")
    public String createCoursePostMethod(
            @ModelAttribute("course") Course course,
            HttpSession session){
        User user = (User)session.getAttribute("user");
        String teacherName = user.getFirstName() + " " + user.getLastName();
        course.setTeacherName(teacherName);
        courseService.createCourse(course);
        userCourseMapService.saveUserCourseMap(new UserCourseMap(new UserCoursePK(course, user)));
        return "redirect:" + course.getId() + "/course";
    }

    @GetMapping("courses")
    public String getTeacherCourses(Model model,
                                    HttpSession session){
        User user = (User)session.getAttribute("user");
        List<UserCourseMap> courses = courseService.getAllUserCourses(user.getId());
        model.addAttribute("courses", courses);
        return "teacher/courses";
    }

    @GetMapping("/course/{id}")
    public String getCourse(@PathVariable("id") Long id
                            , Model model){
        CourseDTO courseInfo = courseService.getCourseData(id);
        model.addAttribute("courseInfo", courseInfo);
        return "teacher/course";
    }

    @GetMapping("/course/{id}/newMaterial")
    public String addNewMaterialGetMethod(@PathVariable("id") Long id
            ,Model model){
        model.addAttribute("courseMaterial", new CourseMaterial());
        return "teacher/newMaterial";
    }

    @PostMapping("/course/newMaterial")
    public String addNewMaterialPostMethod(
            @ModelAttribute("courseMaterial") CourseMaterial courseMaterial,
            HttpServletRequest request){
        Long id = Long.parseLong(request.getParameter("cId"));
        Course course = courseService.getCourseById(id);
        courseMaterial.setCourse(course);
        String videoLink = courseMaterial.getVideoUrl();
        String parsedVideoLink = YouTubeLinkParser.parseLink(videoLink);
        courseMaterial.setVideoUrl(parsedVideoLink);
        courseMaterialService.saveCourseMaterial(courseMaterial);
        userMaterialMapService.addMaterialForAllUsers(courseMaterial);
        return "redirect:"+ id +"/courseMaterial/" + courseMaterial.getCourseMaterialId();
    }

    @GetMapping("/course/{idOfCourse}/courseMaterial/{idOfMaterial}")
    public String getCourseMaterial(@PathVariable("idOfCourse") Long courseId,
                                    @PathVariable("idOfMaterial") Long courseMaterialId,
                                    Model model){
        CourseMaterial courseMaterial = courseMaterialService.getCourseMaterialByCourseMaterialId(courseMaterialId);
        List<Task> listOfTasks = taskService.getMaterialTasks(courseMaterial);
        model.addAttribute("courseMaterial", courseMaterial);
        model.addAttribute("task", new Task());
        model.addAttribute("variant", new Variant());
        model.addAttribute("tasks", listOfTasks);
        return "teacher/material";
    }

    @PostMapping("/createNewTask")
    public String createNewTask(
            @ModelAttribute("task") Task task,
            HttpServletRequest request){
        long courseId = Long.parseLong(request.getParameter("cId"));
        long materialId = Long.parseLong(request.getParameter("cmId"));
        CourseMaterial courseMaterial = courseMaterialService.getCourseMaterialByCourseMaterialId(materialId);
        task.setCourseMaterial(courseMaterial);
        taskService.saveTask(task);
        return "redirect:course/" + courseId + "/courseMaterial/" + materialId;
    }

}
