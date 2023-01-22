## XO GAME Concept
- สามารถกำหนดขนาดของตารางเป็นขนาดใดๆ ได้
- มีระบบฐานข้อมูลเก็บ History play ของเกมเพื่อดู Replay
- มีระบบ Bot (Mode Single Player)
- พัฒนาขึ้นมาเพื่อใช้เป็นส่วนหนึ่งของการสมัครงานกับบริษัท Digio

## Built with
- ![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
- ![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)
- ![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
- ![jQuery](https://img.shields.io/badge/jquery-%230769AD.svg?style=for-the-badge&logo=jquery&logoColor=white)
- ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)


## Requirements
- ![NodeJS](https://img.shields.io/badge/node.js-6DA55F?style=for-the-badge&logo=node.js&logoColor=white)
- ![NPM](https://img.shields.io/badge/NPM-%23000000.svg?style=for-the-badge&logo=npm&logoColor=white)

## Installing
```
git clone https://github.com/NitipatPunoi/xo-game.git
```
```
cd xo-game
```
```
npm install
```

Database: `` database/game_replay.sql ``

## Game Setting (Option)
ผู้เล่นสามารถกำหนดขนาดของตารางได้ที่เมนู option ภายในเกม *Main Menu -> Option* 

| Setting       | Default | Default |
| ------------- |:-------:|:-------:|
| Row           |    3    | ขนาดแถวของตาราง (แนวนอน) |
| Column        |    3    | ขนาดแนวของตาราง (แนวตั้ง) |
| Win Condition |    3    | จำนวนสัญลักษณ์ที่จะต้องเรียงติดกันเพื่อชนะเกม |

ระบุจำนวนที่ต้องการจากนั้นกด `` Save `` เพื่อบันทึกค่า setting

## Game Play 
ผู้เล่นสามารถ เริ่มเกมได้โดยเข้าเมนู `` Main Menu `` -> `` Let's Play `` และเลือก Mode ที่ต้องการเล่น
- **Single Player** ผู้เล่นจะต่อสู้กับ Bot
- **Multiplayer** ผู้เล่นจะต่อสู้กับผู้เล่นด้วยกัน

## Game Rules
- ผู้เล่นที่ 1 (Player 1) จะได้เริ่มเล่นก่อนและใช้สัญลักษณ์กากบาท (X) เสมอ
- ถ้าหากผู้เล่นใดสามาถวางสัญลักษณ์ของตนให้เรียงกันได้มากกว่าหรือเท่ากับจำนวน Win Condition จะเป็นผู้ชนะเกมและสิ้นสุดเกม
- หากผู้เล่นทั้งสองฝ่ายวางสัญลักษณ์จนเต็มกระดานแล้ว และไม่สามาถหาผู้ชนะได้ จะถือว่าเกมนั้นมีผลเสมอกันและสิ้นสุดเกม

## Replay
- เมื่อเกมสิ้นสุด ไม่ว่าจะมีผู้ชนะหรือเสมอกันก็ตาม ระบบจะทำการบันทึก Replay ของเกมนั้นไว้ และสามารถเรียกดูย้อนหลังได้ที่ `` Main Menu `` -> `` Replay ``
- หากปิดเกมหรือเริ่มเกมใหม่ก่อนเกมจะสิ้นสุด ระบบจะไม่ทำการบันทึก Replay ของเกมนั้น

## Game Algorithm 
- เมื่อผู้เล่นเข้าสุ่หน้า *play* ระบบจะทำการสร้างกระดานและ State[^1]. ตามขนาดของ Game Setting
- เมื่อมีการวางสัญลักษณ์กากบาท (X) หรือ วงกลม (O) ระบบจะทำการ Log State และ
  ตรวจสอบเงื่อนไขการชนะเกม (**Winning Condition**) 4 รูปแบบดังนี้
  - **Row Combo** โดยจะตรวจสอบช่องของตาราง (Cell) ผ่าน State[^1]. หากมีสัญลักษณ์ที่เหมือนกันเรียงติดกันในแนวนอนเป็นจำนวนมากกว่าหรือเท่ากับ Win Condition 
  - **Column Combo** โดยจะตรวจสอบช่องของตาราง (Cell) ผ่าน State[^1]. หากมีสัญลักษณ์ที่เหมือนกันเรียงติดกันในแนวตั้งเป็นจำนวนมากกว่าหรือเท่ากับ Win Condition 
  - **Diagonally Down Combo** โดยจะตรวจสอบช่องของตาราง (Cell) ผ่าน State[^1]. หากมีสัญลักษณ์ที่เหมือนกันเรียงติดกันในแนวทแยงลงเป็นจำนวนมากกว่าหรือเท่ากับ Win Condition 
  - **Diagonally Up Combo** โดยจะตรวจสอบช่องของตาราง (Cell) ผ่าน State[^1]. หากมีสัญลักษณ์ที่เหมือนกันเรียงติดกันในแนวทแยงขึ้นเป็นจำนวนมากกว่าหรือเท่ากับ Win Condition 
- หากมีการวางสัญลักษณ์ตรงกับเงื่อนไขการชนะเกม (**Winning Condition**) ข้อใดข้อหนึ่งเกมจะสิ้นสุดและให้ผู้เล่นของสัญลักษณ์นั้นเป็นผู้ชนะ
- หากไม่เข้าเงื่อนไขใดเลยระบบจะทำการตรวจสอบเงื่อนไขการเสมอ (**Drawing Condition**) โดยจะตรวจสอบช่องของตาราง (Cell) หากไม่มีช่องที่เล่นได้ (Playable)
  เกมจะสิ้นสุดและให้ผู้เล่นทั้งสองเสมอกัน แต่ถ้าหากไม่เข้าเงื่อนไขทั้งสอง (**Winning Condition & Drawing Condition**) ระบบจะทำการเปลี่ยนฝ่ายเล่น (Turn Change) และทำการเล่นต่อ 
- ถ้า Bot เป็นฝ่ายเล่น Bot จะตรวจสอบจำนวนช่องของตาราง (Cell) ที่เล่นได้ (Playable) และทำการสุ่มวางสัญลักษณ์


## Author
- **Nitipat Punoi** 
- *Punoi.n@gmail.com* 
- *083-407-9422* 

[^1]: State คือ 2D Array ขนาดเท่ากับจำนวนช่อง (Cell) ของกระดาน ใช้เพื่อตรวจสอบเงื่อนไขการชนะ
