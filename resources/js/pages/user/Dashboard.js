import React, { useReducer } from 'react';
import ReactDOM from 'react-dom';
import Sidebar from './Sidebar';

const Dashboard = ({ course_enrolement, batch_enrolement, user }) => {
    console.log(course_enrolement, batch_enrolement, user);
    let enroledCourses = <div class="single-course">
                            <a href="#" class="avatar avatar-4by3 overlay overlay--primary mr-12pt">
                                <span class="overlay__content"></span>
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt" href="#">No Enrolled Courses</a>
                            </div>
                        </div>;
        if (course_enrolement.length > 0) {
            enroledCourses = course_enrolement.map(cenrolement=>{
                const courseUrl = "/course/course-preview/"+cenrolement.course.slug;
                return <div className="single-course">
                        <a href={courseUrl} className="avatar avatar-4by3 mr-12pt">
                            {cenrolement.course.logo ? 
                                <img src={"/storage/"+cenrolement.course.logo} class="avatar-img rounded" alt="course" />
                            :
                                <img src="/student/public/images/paths/mailchimp_430x168.png" class="avatar-img rounded" alt="course" />
                            }
                            <span class="overlay__content"></span>
                        </a>
                        <div class="flex">
                            <a class="card-title mb-4pt" href={courseUrl}>{cenrolement.course.title}</a>
                        </div>
                    </div>
            })
        }
    let enroledBatches = <div class="single-course">
                            <a href="#" class="avatar avatar-4by3 mr-12pt">
                                <span class="overlay__content"></span>
                            </a>
                            <div class="flex">
                                <a class="card-title mb-4pt" href="#">No batches</a>
                            </div>
                        </div>;
    if (batch_enrolement.length > 0) {
        enroledBatches = batch_enrolement.map(benrolement=>{
            const bcourseUrl = "/batch/"+benrolement.batch.slug;
            return <div class="single-course">
                <a href={bcourseUrl} class="avatar avatar-4by3 mr-12pt">
                    {benrolement.course.logo ? 
                        <img src={"/storage/"+benrolement.course.logo} class="avatar-img rounded" alt="course" />
                    :
                        <img src="/student/public/images/paths/mailchimp_430x168.png" class="avatar-img rounded" alt="course" />
                    }
                    <span class="overlay__content"></span>
                </a>
                <div class="flex">
                    <a class="card-title mb-4pt" href={bcourseUrl}>{benrolement.batch.title}</a>
                </div>
            </div>
        })
    }              

    return <div>
        <Sidebar />
        <div class="container-fluid ml-6">
        <div class="row">
            <div class="col-md-4">
                <div class="student-info pt-5 pl-4">
                    <h2>Hello {user.name}</h2>
                    <p>Nice to have you back</p>
                </div>
                <div class="page-headline text-left">
                    <h2 className="text-xsm">Your enrolled courses</h2>
                </div>
                <div className="mb-4">
                {enroledCourses}
                </div>
    
                <div class="page-headline text-left">
                    <h2 className="text-xsm">Your Batches</h2>
                </div>
                {enroledBatches}
            </div>
            <div class="col-md-8">

            </div>
        </div>
    </div>
    </div>;
}

export default Dashboard;

if (document.getElementById('studentDashboard')) {
    const el = document.getElementById('studentDashboard');
    const course_enrolement = el.getAttribute('data-course-enrolement') ? JSON.parse(el.getAttribute('data-course-enrolement')) : [];
    const user = el.getAttribute('data-user') ? JSON.parse(el.getAttribute('data-user')) : [];
    const batch_enrolement = el.getAttribute('data-batch-enrolement') ? JSON.parse(el.getAttribute('data-batch-enrolement')) : [];
    ReactDOM.render(<Dashboard course_enrolement={course_enrolement} batch_enrolement={batch_enrolement} user={user} />, el);
}