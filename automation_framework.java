
import java.io.File;
import java.util.List;

import org.apache.commons.io.FileUtils;
import org.openqa.selenium.By;
import org.openqa.selenium.OutputType;
import org.openqa.selenium.TakesScreenshot;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.ui.Select;

public class Helper_methods {
	WebDriver driver;
	
	public Helper_methods(WebDriver driver){
		this.driver= driver;
	}
	
	public WebElement fetchElementByType(String uniqeName, String type) {
		type= type.toLowerCase();
		if(type.equals("id")){
			System.out.println("Found element by id: " + uniqeName);
			return this.driver.findElement(By.id(uniqeName));
		} else if (type.equals("name")){
			System.out.println("Found element by name: " + uniqeName);
			return this.driver.findElement(By.name(uniqeName));
		} else if(type.equals("class")){
			System.out.println("Found element by class: " + uniqeName);
			return this.driver.findElement(By.className(uniqeName));
		} else if(type.equals("xpath")){
			System.out.println("Found element by xPath: " + uniqeName);
			return this.driver.findElement(By.xpath(uniqeName));
		} else if(type.equals("tag")) {
			System.out.println("Found element by tagName: " + uniqeName);
			return this.driver.findElement(By.tagName(uniqeName));
		} else if(type.equals("linkText")){
			System.out.println("Found element by linkText: " + uniqeName);
			return this.driver.findElement(By.linkText(uniqeName));
		} else if(type.equals("partialLinkText")){
			System.out.println("Found element by partialLinkText: " + uniqeName);
			return this.driver.findElement(By.partialLinkText(uniqeName));
		} else {
			System.out.println("Found element by cssSelector: " + uniqeName);
			return this.driver.findElement(By.cssSelector(uniqeName));
		}
	}
	
	public List<WebElement> fetchElements(String uniqeName, String type) {
		type= type.toLowerCase();
		if(type.equals("id")){
			return this.driver.findElements(By.id(uniqeName));
		} else if (type.equals("name")){
			return this.driver.findElements(By.name(uniqeName));
		} else if(type.equals("class")){
			return this.driver.findElements(By.className(uniqeName));
		} else if(type.equals("xpath")){
			return this.driver.findElements(By.xpath(uniqeName));
		} else if(type.equals("tag")) {
			return this.driver.findElements(By.tagName(uniqeName));
		} else if(type.equals("linkText")){
			return this.driver.findElements(By.linkText(uniqeName));
		} else if(type.equals("partialLinkText")){
			return this.driver.findElements(By.partialLinkText(uniqeName));
		} else {
			return this.driver.findElements(By.cssSelector(uniqeName));
		}
	}
	
	public boolean isElementPresent(String uniqeName, String type) {
		List<WebElement> elements= fetchElements(uniqeName, type);
		int size= elements.size();
		if(size > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public WebElement fetchElementById(String id, String sendKey){
		WebElement element= driver.findElement(By.id(id));
		element.sendKeys(sendKey);
		return element;
	}
	
	public WebElement fetchElementByxPath(String xPath, String sendKey){
		WebElement element= driver.findElement(By.xpath(xPath));
		element.sendKeys(sendKey);
		return element;
	}
	
	public WebElement fetchElementByName(String name, String sendKey){
		WebElement element= driver.findElement(By.name(name));
		element.sendKeys(sendKey);
		return element;
	}
	
	public void dropDownByName(String locator, String visibleText){
		Select dropDown= new Select(driver.findElement(By.name(locator)));
		dropDown.selectByVisibleText(visibleText);
	}
	
	public void uploadFileByName(String locator, String file){
		WebElement upload= driver.findElement(By.name(locator));
		upload.sendKeys(file);
	}
	
	public void clickButtonById(String id){
		WebElement button= driver.findElement(By.id(id));
		button.click();
	}
	
	public void clickButtonByXpath(String xPath){
		WebElement button= driver.findElement(By.xpath(xPath));
		button.click();
	}
	
	public void getURL(String url){
		driver.get(url);
	}
	
	public void screenCapture() throws Exception{
		String filename= Math.random() + ".png";
		String directory= "/Users/Ocean/Desktop/";
		File sourceFile= ((TakesScreenshot)driver).getScreenshotAs(OutputType.FILE);
		FileUtils.copyFile(sourceFile, new File(directory + filename));
		System.out.println("Screen Capture sent to desktop");
	}
}
