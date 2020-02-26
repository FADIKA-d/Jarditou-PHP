
const changementBtn = () => {
    const wrap = 
        document.querySelector('img')

        wrap.addEventListener('click',() =>{
            modeNuit()
        })
    }
        const modeNuit = () => {

            document.querySelectorAll('body').forEach(body => {
                body.classList.toggle('bodyNuit')
            })

            document.querySelectorAll('header').forEach(header => {
                header.classList.toggle('headerN')
            })

            document.querySelectorAll('img').forEach(img => {
                img.attributes.remove = "src"
                img.classList.toggle('imgN')
            })
            document.querySelectorAll('.btn').forEach(btn => {
                btn.classList.toggle('btnNuit')
            })
            document.querySelectorAll('.wrapSection').forEach(wrapSection => {
                wrapSection.classList.toggle('wrapSectionNuit')
            })
            
            document.querySelectorAll('.wrapArticle').forEach(wrapArticle => {
                wrapArticle.classList.toggle('wrapArticleNuit')
            })

            document.querySelectorAll('.titre').forEach(titre => {
                titre.classList.toggle('titreNuit')
            })

            document.querySelectorAll('.para').forEach(para => {
                para.classList.toggle('paraNuit')
            })
            document.querySelectorAll('div').forEach(div => {
                div.classList.toggle('divNuit')
            })

        }
        changementBtn()

