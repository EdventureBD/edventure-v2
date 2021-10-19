import React, { useReducer } from 'react';
import ReactDOM from 'react-dom';
import parse from 'html-react-parser';

const BatchExamMCQ = ({questions, batch, exam}) => {
    console.log(questions);
    console.log(batch);
    console.log(exam);
    const [state, setState] = useReducer(
        (state, newState) => ({ ...state, ...newState }),
        {
            selected : []
        });

    let questionRows = '';
    const fields = [1,2,3,4];
    let sl = 1;

    const selectAnswer = (q, a) => {
        const cSelected = state.selected.filter(selec=>(selec !== q+'_'+1 && selec !== q+'_'+2 && selec !== q+'_'+3 && selec !== q+'_'+4));
        console.log(cSelected);
        cSelected.push(q+'_'+a);

        setState({selected : cSelected});
    }

    questionRows = questions.map((question, index)=> {
        sl = index + 1;
        return <div className="question mb-5">
                <div className="bg-purple-light p-2 mb-3 bshadow bradius-15"><b>{"Q "+sl+".  "}</b>{parse(question.question)}</div>
                {
                    fields.map(fieldNo=>(<div className={`${state.selected.includes(question.id+'_'+fieldNo) ? "bg-purple-light" : "bg-light-gray"} bshadow bradius-15 w-50 p-2 mb-3`} onClick={()=>selectAnswer(question.id, fieldNo)}>{fieldNo+'. '} {parse(question['field'+fieldNo])}</div>))
                }
        </div>
    }) 
    let questionSummary = [];
    for (let i=1; i<=10; i++) {
        questionSummary.push(<div class="single-qus-summary">{i}</div>)
    }

    return (<div className="batch-exam">
                <div className="container">
                    <div className="row py-5">
                        <div className="col-4"><h2 className="text-purple">{exam.title}</h2></div>
                        <div className="col-4"><h2 className="text-purple text-xmd fw-800">{batch.title}</h2></div>
                        <div className="col-4"><div className="timer"></div></div>
                    </div>
                    {questionRows}
                    <div className="question-summary">
                        {questionSummary}
                    </div>
                </div>
            </div>)
}

export default BatchExamMCQ;

if (document.getElementById('BatchExamMCQ')) {
    const el = document.getElementById('BatchExamMCQ');
    const questions = el.getAttribute('data-questions') ? JSON.parse(el.getAttribute('data-questions')) : [];
    const exam = el.getAttribute('data-exam') ? JSON.parse(el.getAttribute('data-exam')) : [];
    const batch = el.getAttribute('data-batch') ? JSON.parse(el.getAttribute('data-batch')) : [];
    ReactDOM.render(<BatchExamMCQ  questions={questions} exam={exam} batch={batch} />, el);
}