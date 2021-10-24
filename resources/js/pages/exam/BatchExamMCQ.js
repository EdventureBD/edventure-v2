import React, { useReducer } from 'react';
import ReactDOM from 'react-dom';
import parse from 'html-react-parser';
import Timer from '../../components/Timer';
import Axios from 'axios';

const BatchExamMCQ = ({ questions, batch, exam }) => {
    console.log(questions);
    console.log(batch);
    console.log(exam);
    const [state, setState] = useReducer(
        (state, newState) => ({ ...state, ...newState }),
        {
            answers: [],
            error: false
        });

    let questionRows = '';
    const fields = [1, 2, 3, 4];
    let sl = 1;

    const selectAnswer = (q, a) => {
        const answers = state.answers.filter(answer => (answer !== q + '_' + 1 && answer !== q + '_' + 2 && answer !== q + '_' + 3 && answer !== q + '_' + 4));
        answers.push(q + '_' + a);
        setState({ answers: answers, error: false });
    }

    const submitExam = async (e) => {
        e.preventDefault();
        if (state.answers.length < questions.length) {
            setState({ error: true })
        } else {
            console.log('submit form');
            // $("#exam-form").submit();
            const url = "/batch/" + batch.slug + "/" + exam.slug + "/result";
            const res = await axios.post(url, { a: state.answers, q: questions })
                .then(response => {
                    console.log(response.data);
                    window.location.reload();
                }).catch(error => {
                    console.log(error);
                });
        }
    }

    questionRows = questions.map((question, index) => {
        sl = index + 1;
        return <div className="question mb-5" id={"qus_" + question.id}>
            <div className="bg-purple-light p-2 mb-3 bshadow bradius-15"><b>{"Q " + sl + ".  "}</b>{parse(question.question)}</div>
            {
                fields.map(fieldNo => (<div className={`${state.answers.includes(question.id + '_' + fieldNo) ? "bg-purple-light" : "bg-light-gray"} bshadow bradius-15 w-50 p-2 mb-3`} onClick={() => selectAnswer(question.id, fieldNo)}>{fieldNo + '. '} {parse(question['field' + fieldNo])}</div>))
            }
        </div>
    })

    let questionSummary = [];
    questions.map((qus, qindex) => {
        let sanswer = state.answers.find(answer => answer == qus.id + '_' + 1 || answer == qus.id + '_' + 2 || answer == qus.id + '_' + 3 || answer == qus.id + '_' + 4);
        // console.log(sanswer);
        questionSummary.push(<a href={"#qus_" + qus.id} class={`single-qus-summary ${sanswer ? "bg-red" : "bg-green"} bradius-15 c-point`}>{qindex + 1}</a>)
    })

    return (<div className="batch-exam">
        <div className="container">
            <div className="row py-5">
                <div className="col-4"><h2 className="text-purple">{exam.title}</h2></div>
                <div className="col-4"><h2 className="text-purple text-xmd fw-800">{batch.title}</h2></div>
                <div className="col-4">
                    <div className="timer text-white"><Timer initialMinute={exam.duration ? exam.duration : 30} initialSeconds={0} /></div>
                    <div className="question-summary">
                        {questionSummary}
                    </div>
                </div>
            </div>
            {questionRows}
            <form action={"/batch/" + batch.slug + "/" + exam.slug + "/result"} method="post" id="exam-form" onSubmit={submitExam}>
                <p className={state.error ? "text-red" : "text-red d-none"}>Please answer all the questions!</p>
                <button className="btn text-xxsm fw-800 text-white bg-purple px-4 py-2 mt-3" onSubmit={submitExam}>Submit</button>
            </form>
        </div>
    </div>)
}

export default BatchExamMCQ;

if (document.getElementById('BatchExamMCQ')) {
    const el = document.getElementById('BatchExamMCQ');
    const questions = el.getAttribute('data-questions') ? JSON.parse(el.getAttribute('data-questions')) : [];
    const exam = el.getAttribute('data-exam') ? JSON.parse(el.getAttribute('data-exam')) : [];
    const batch = el.getAttribute('data-batch') ? JSON.parse(el.getAttribute('data-batch')) : [];
    ReactDOM.render(<BatchExamMCQ questions={questions} exam={exam} batch={batch} />, el);
}